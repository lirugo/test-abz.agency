<v-toolbar>
    <v-toolbar-title>{{env('APP_NAME')}}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat to="/catalog">
            <v-icon>assignment_ind</v-icon>
        </v-btn>
        <v-btn flat to="/list">
            <v-icon>group</v-icon>
        </v-btn>
    </v-toolbar-items>
</v-toolbar>