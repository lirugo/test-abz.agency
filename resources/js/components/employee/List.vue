<template>
    <v-container fluid grid-list-md>
        <v-layout>
        <!--Pagination-->
            <v-flex>
                <v-pagination
                    v-model="pagination.current"
                    :length="pagination.last"/>
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
                                    <v-list-tile-title><strong>Employment Date:</strong> {{employee.employement_date}}</v-list-tile-title>
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
                pagination: {
                    current: 1,
                    last: 1
                },
                employees: [],
            }
        },
        created() {
            this.fetchEmployees()
        },
        watch: {
            pagination: {
                handler(){
                    this.fetchEmployees()
                },
                deep: true
            },
        },
        methods: {
            fetchEmployees(){
                fetch('/api/employees?page=' + this.pagination.current)
                    .then(res => res.json())
                    .then(res => {
                        this.pagination.current = res.meta.current_page
                        this.pagination.last = res.meta.last_page
                        //Clear current employees
                        this.employees = []
                        this.employees.push(...res.data)
                    })
                    .catch(err => console.warn(err))
            }
        }
    }
</script>