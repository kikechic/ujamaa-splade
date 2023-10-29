<template>
    <slot v-bind="timesheet" />
</template>

<script setup>
import numeral from "numeral";
import { ref, onMounted } from "vue";

const props = defineProps({
    form: Object,
    days: Object,
    editing: {
        type: Boolean,
        default: false,
    },
});

onMounted(() => {
    resetAllColumnTotals();
    resetAllRowPercentagesAndTotals();

    if (props.editing) {
        initializeTotals();
    }
});

const initializeTotals = () => {
    props.form.hours.forEach((donorHours, rIdx) => {
        props.days.forEach((day, cIdx) => updateDonorTotal(rIdx, cIdx));
    });

    updateOverallDonorTotal();
    updateDonorPercentages();
};

const updateColumnTotals = (cIdx) => {
    resetSingleColumnTotal(cIdx);

    props.form.columnTotals[cIdx] = numeral(props.form.columnDonorTotals[cIdx]).value()

    updateGrandTotal();
};

const updateGrandTotal = () => {
    props.form.grandTotal = numeral(props.form.grandDonorTotal)._value;
};

const updateDonorTotal = (rIdx, cIdx) => {
    resetSingleDonorColumnTotal(cIdx);

    props.form.rowDonorTotals[rIdx] = sum(props.form.hours[rIdx]);

    props.form.hours.forEach((v, i) => {
        props.form.columnDonorTotals[cIdx] += numeral(
            props.form.hours[i][cIdx]
        )._value;
    });

    updateOverallDonorTotal();

    updateDonorPercentages();

    updateColumnTotals(cIdx);
};

const sum = (array) => array.reduce((p, c) => numeral(c)._value + p, 0);

const resetAllColumnTotals = () => {
    props.days.forEach((v, i) => {
        props.form.columnDonorTotals[i] = 0;
        props.form.columnTotals[i] = 0;
    });
};

const resetAllRowPercentagesAndTotals = () => {
    props.form.donor_ids.forEach((v, i) => {
        props.form.rowDonorPercentages[i] = numeral(0).format("0.00%");
        props.form.rowDonorTotals[i] = 0;
    });
};

const resetSingleDonorColumnTotal = (index) =>
    (props.form.columnDonorTotals[index] = 0);

const resetSingleColumnTotal = (index) => (props.form.columnTotals[index] = 0);

const updateOverallDonorTotal = () => {
    props.form.grandDonorTotal = sum(props.form.rowDonorTotals);
};

const updateDonorPercentages = () => {
    props.form.rowDonorTotals.forEach((value, index) => {
        props.form.rowDonorPercentages[index] = numeral(
            props.form.grandDonorTotal == 0
                ? 0
                : ((value / props.form.grandDonorTotal) * 100) / 100
        ).format("0.00%");
    });
};

const timesheet = ref({
    updateDonorTotal,
});
</script>
