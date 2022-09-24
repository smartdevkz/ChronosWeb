<template>
    <select class="form-select" style="width:auto;" @change="onChange($event)" v-model="timeunit" v-bind:name="id+'_time_unit'">
        <option value="0">Не выбрано</option>
        <option value="1">Век</option>
        <option value="2">Тысячелетие</option>
        <option value="3">Дата</option>
        <option value="4">Год</option>
    </select>
    <input type="checkbox" v-bind:name="id+'_is_before_christ'" /> д.н.э
    <span v-if="timeunit==0">
    </span>
    <span v-if="timeunit!=3 && timeunit!=0">
        <input v-bind:name="id+'_str'">
    </span>
    <span v-if="timeunit==3">
        <input type="date" v-bind:name="id+'_str'">
    </span>
</template>

<script>
export default {
    props: { id: String, timeunit: String },
    data() {
        return {
            selectedTimeUnit: 0
        }
    },
    mounted() {
        console.log("Component mounted.");
        console.log(this.timeunit);
    }
};
</script>
