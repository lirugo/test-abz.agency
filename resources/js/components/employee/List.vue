<template>
    <v-container fluid grid-list-md>
        <!--Loader-->
        <loader :loader="loader"></loader>
        <!--Pagination-->
        <v-layout row wrap>
            <v-flex xs12 sm12 md6 fill-height>
                <v-pagination
                        class="pt-3"
                        v-model="pagination.current"
                        :length="pagination.last"
                        total-visible="10"/>
                <div class="caption grey--text ml-2">{{ pagination.total }} records</div>
            </v-flex>
            <v-flex xs12 sm6 md2 offset-md1>
                <v-select
                        :items="pagination.pageSizes"
                        v-model="pagination.pageSize"
                        menu-props="auto"
                        label="Page size"
                        prepend-icon="pages"
                        hint="Pick page size"
                        persistent-hint
                        single-line
                ></v-select>
            </v-flex>
            <v-flex xs12 sm6 md3>
                <v-text-field
                        v-model="search"
                        ref="search"
                        label="Search Algolia"
                        append-outer-icon="search"
                        hint="Start typing..."
                        persistent-hint
                ></v-text-field>
            </v-flex>
        </v-layout>
        <!--Employee list-->
        <v-layout row wrap>
            <v-flex xs12 sm6 md4 lg3 xl2  v-for="employee in employees" :key="employee.id">
                <!--Employee card-->
                <v-hover>
                    <v-card
                            slot-scope="{ hover }"
                            :class="`elevation-${hover ? 12 : 2}`"
                            class="mx-auto"
                    >
                        <v-img
                                class="white--text"
                                height="200px"
                                :src="'https://api.adorable.io/avatars/200/' + employee.email + '.png'"
                        >
                        </v-img>
                        <v-card-title>
                            <div>
                                <h3 class="headline mb-0">{{employee.name}}</h3>
                                <span class="grey--text">{{employee.email}}</span><br>
                                <v-list>
                                    <v-list-tile-title><strong>Salary:</strong> {{employee.salary}} $</v-list-tile-title>
                                    <v-list-tile-title><strong>Employment Date:</strong> {{employee.employment_date}}</v-list-tile-title>
                                    <v-list-tile-title v-for="position in employee.staff_positions" :key="position.id"><strong>Staff positions:</strong> {{position}}</v-list-tile-title>
                                </v-list>
                            </div>
                        </v-card-title>
                    </v-card>
                </v-hover>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data(){
            return {
                loader: true,
                pagination: {
                    current: 1,
                    last: 1,
                    total: 0,
                    pageSize: 10,
                    pageSizes: [5,10,20,50,100],
                },
                search: '',
                employees: [],
            }
        },
        created() {
            this.fetchEmployees()
        },
        watch: {
            pagination: {
                handler(){
                    //TODO:: check it
                    if(this.search.length == 0)
                        this.fetchEmployees()
                    else this.searchMethod()
                },
                deep: true
            },
            search: 'searchMethod'
        },
        methods: {
            fetchEmployees(){
                this.loader = true
                fetch('/api/employees?page_size=' + this.pagination.pageSize + '&page=' + this.pagination.current)
                    .then(res => res.json())
                    .then(res => {
                        this.pagination.current = res.meta.current_page
                        this.pagination.last = res.meta.last_page
                        this.pagination.total = res.meta.total
                        //Clear current employees
                        this.employees = []
                        this.employees.push(...res.data)
                    })
                    .finally(() => (
                        this.loader = false
                    ))
                    .catch(err => console.warn(err))
            },
            searchMethod: _.debounce(function(){
                if (this.search.length > 2){
                    console.log('send')
                    this.loader = true
                    fetch('/api/employees/search?key=' + this.search + '&page_size=' + this.pagination.pageSize + '&page=' + this.pagination.current)
                        .then(res => res.json())
                        .then(res => {
                            this.pagination.current = res.meta.current_page
                            this.pagination.last = res.meta.last_page
                            this.pagination.total = res.meta.total
                            //Get search result
                            this.employees = []
                            this.employees.push(...res.data)
                            //Set back focus on search input
                            this.$refs.search.focus()
                        })
                        .finally(() => (
                            this.loader = false
                        ))
                        .catch(err => console.warn(err))
                }
            }, 600)
        },
    }
</script>