@if ($name)
    <p class="mt-1 font-sans text-xs text-red-600" v-if="form.hasError(@js($name))"
        v-bind="form.$errorAttributes(@js($name))" />
@endif
