<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentSequence;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentSequencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('document_sequences')->truncate();

        $documentSequences = [
            ['prefix' => 'STS', 'delimiter' => '-', 'document_code' => 'timesheet', 'sequence_number' => 0,],
            ['prefix' => 'EMP', 'delimiter' => '-', 'document_code' => 'employee', 'sequence_number' => 0,],
        ];

        foreach ($documentSequences as $documentSequence) {
            DocumentSequence::factory()->create($documentSequence);
        }
    }
}
