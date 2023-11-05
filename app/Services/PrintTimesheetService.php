<?php

namespace App\Services;

use App\Models\LeaveType;
use App\Models\Timesheet;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintTimesheetService
{
    protected int $fontSize = 8;
    protected string $documentName = 'Timesheet';
    protected int|string $documentNumber;
    protected Timesheet $timesheet;
    protected int $margin;

    public function defaultFooter($renderedPdf, $documentNumber, int $margin = 35)
    {
        $this->documentNumber = $documentNumber;

        $this->margin = $margin;

        $canvas = $renderedPdf->getCanvas();

        $canvas->page_script(function ($pageNumber, $pageCount, $canvas, $fontMetrics) {

            $fontStyle = $fontMetrics->getFont("Helvetica", "normal");
            $canvasWidth = $canvas->get_width();
            $y = $canvas->get_height() - $this->margin;

            $pageCountText = __('Page') . " {$pageNumber} / {$pageCount}";
            $x = $this->margin;
            $canvas->text($x, $y, $pageCountText, $fontStyle, $this->fontSize);

            $documentNumberText = __($this->documentName) . " No: {$this->documentNumber}";
            $documentNumberTextWidth = $fontMetrics->get_text_width($documentNumberText, $fontStyle, $this->fontSize);
            $x = $canvasWidth - $documentNumberTextWidth - $this->margin;
            $canvas->text($x, $y, $documentNumberText, $fontStyle, $this->fontSize);
        });
    }

    public function logoSize($document)
    {
        $document->company->logo_url = ($media = $document->company->getFirstMedia('logos')) ? $media->getUrl() : '';

        return \App\Helpers\Helpers::logoSize($media);
    }

    public function setTimesheet(Timesheet $timesheet): self
    {
        $this->timesheet = $timesheet;
        return $this;
    }

    public function print()
    {
        $timesheetService = (new TimesheetService)
            ->setDocument($this->timesheet)
            ->setTimesheetPeriod($this->timesheet->timesheetPeriod)
            ->showFrontEnd();

        $pdf = Pdf::loadView(
            'timesheets.pdf',
            [
                'timesheet' => $this->timesheet->loadMissing('timesheetEntries', 'department', 'employee', 'designation'),
                'logoSize' => $this->logoSize($this->timesheet),
                'days' => $timesheetService->getDays(),
                'totals' => $timesheetService->getTotals(),
                'leaveTypes' => LeaveType::query()->select('id', 'code', 'name')->get(),
            ]
        )
            ->setOption('enable_php', true)
            ->setPaper('a4', 'landscape');

        $pdf->render();

        $this->defaultFooter(
            renderedPdf: $pdf,
            documentNumber: $this->timesheet->timesheet_number,
        );

        return $pdf;
    }
}
