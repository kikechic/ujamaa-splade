<div class="mb-5 flex flex-row flex-nowrap">
	<div class="w-full shrink grow basis-0">
		<div class="inline-flex min-h-[28px] w-full space-x-1">
			<div class="flex w-2/5 flex-row space-x-1 py-2 pr-0 text-xs">
				<span>
					@if (isset($label))
						{{ $label }}
					@endif
				</span>
				<div class="grow bg-dot bg-center bg-repeat-x"></div>
			</div>
			<div
				class="h-full min-h-[28px] w-3/5 overflow-ellipsis bg-slate-100 px-2 py-2"
			>
				{{ $slot }}
			</div>
		</div>
	</div>
</div>
