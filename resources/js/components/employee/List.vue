<template>
    <v-container fluid grid-list-md>
        <!--Employee list-->
        <v-layout row wrap>
            <v-flex xs12>
                <!--External pagination-->
                <div class="mb-2">
                    <v-pagination
                            v-model="pagination.page"
                            :length="pagination.lastPage"
                            :total-visible="10"
                    ></v-pagination>
                </div>
                <!--Table-->
                <v-data-table
                        :headers="headers"
                        :items="employees"
                        :total-items="pagination.totalItems"
                        :loading="loading"
                        :rows-per-page-items="pagination.rowsPerPageItems"
                        class="elevation-1"
                        :pagination.sync="pagination"
                >
                    <template slot="items" slot-scope="props">
                        <td>{{ props.item.name }}</td>
                        <td class="text-xs-right">{{ props.item.department }}</td>
                        <td class="text-xs-right">{{ props.item.city }}</td>
                        <td class="text-xs-right">{{ props.item.email }}</td>
                        <td class="text-xs-right">{{ props.item.salary }} $</td>
                        <td class="text-xs-right">{{ props.item.employment_date }}</td>
                        <td class="text-xs-right">
                            <span v-for="staffPosition in props.item.staff_positions">{{staffPosition}} </span>
                        </td>
                        <td class="text-xs-center">{{ props.item.gender == 'f' ? 'F' : 'M' }}</td>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data(){
            return {
                loading: true,
                pagination: {
                    descending: false,
                    page: 1,
                    lastPage: 1,
                    rowsPerPage: 10,
                    rowsPerPageItems: [5,10,20],
                    sortBy: '',
                    totalItems: 0,
                },
                employees: [],
                headers: [
                    {
                        text: 'Name',
                        align: 'left',
                        value: 'first_name'
                    },
                    { text: 'Department', value: 'dep' },
                    { text: 'City', value: 'city' },
                    { text: 'Email', value: 'email' },
                    { text: 'Salary', value: 'getSalary' },
                    { text: 'Employment Date', value: 'employment_date' },
                    { text: 'Staff Positions', value: 'staff_positions' },
                    { text: 'Gender', value: 'gender' },
                ],
            }
        },
        created() {
            this.fetchEmployees()
        },
        watch: {
            pagination: {
                handler () {
                    this.fetchEmployees()
                },
                deep: true
            }
        },
        methods: {
            fetchEmployees(){
                this.loading = true
                let config = {
                    params: {
                        page: this.pagination.page,
                        rowsPerPage: this.pagination.rowsPerPage,
                        sortBy: this.pagination.sortBy,
                        descending: this.pagination.descending,
                    },
                }
                axios.get('/api/employees/', config)
                    .then(res => res.data)
                    .then(res => {
                        this.pagination.lastPage = res.meta.last_page
                        this.pagination.totalItems = res.meta.total
                        this.employees = res.data
                    })
                    .finally(() => (
                        this.loading = false
                    ))
                    .catch(err => console.warn(err))
            },
        },
    }
</script>