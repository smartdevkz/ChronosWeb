<template>
    <div>
        <select @change="onCategoryChange($event)" v-model="selectedCategory">
            <option value="0">Not selected</option>
            <option v-for="item in categories" v-bind:value="{ id: item.id, text: item.name }">
                {{ item.name }}
            </option>
        </select>
    </div>

    <div>
        <select @change="onCountryChange($event)" v-model="selectedCountry">
            <option value="0">Not selected</option>
            <option v-for="item in countries" v-bind:value="{ id: item.id, text: item.name }">
                {{ item.name }}
            </option>
        </select>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>TimeUnit</th>
                <th v-for="item in selectedCountries" :key="item.id">
                    {{ item.text }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in events" :key="item.id">
                <td>{{ item.start_date_str }}</td>
                <td v-for="country in selectedCountries" :key="country.id">
                    {{ item[country.id]?.description }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data() {
        return {
            events: [],
            categories: [],
            countries: [],
            selectedCategories: [],
            selectedCategory: 0,
            categoryIds: '',
            selectedCountries: [],
            selectedCountry: 0,
            countryIds: ''
        }
    },
    mounted() {
        console.log("Component mounted.");
    },
    created() {
        this.getCategories();
        this.getCountries();
    },
    methods: {
        getItems() {
            axios
                .get(`api/events?categoryIds=${this.categoryIds}&countryIds=${this.countryIds}`)
                .then(res => {
                    this.events = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getCategories() {
            axios
                .get("api/categories")
                .then(res => {
                    this.categories = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getCountries() {
            axios
                .get("api/countries")
                .then(res => {
                    this.countries = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        onCategoryChange() {
            if (this.selectedCategories.filter(e => e.id === this.selectedCategory.id).length == 0) {
                this.selectedCategories.push(this.selectedCategory);
            }
            this.categoryIds = this.selectedCategories.map(i => i.id).join(',');
            console.log(this.categoryIds);
            this.getItems();
        },
        onCountryChange() {
            if (this.selectedCountries.filter(e => e.id === this.selectedCountry.id).length == 0) {
                this.selectedCountries.push(this.selectedCountry);
            }
            this.countryIds = this.selectedCountries.map(i => i.id).join(',');
            this.getItems();
        }
    }
};
</script>