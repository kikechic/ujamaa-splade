<template>
    <VDropdown :distance="6" class="flex items-center justify-center h-full">
        <!-- This will be the popover reference (for the events and position) -->
        <slot name="trigger" />

        <!-- This will be the content of the popover -->
        <template #popper="{ hide }">
            <slot></slot>
        </template>
    </VDropdown>
</template>
<script setup></script>
