<template>
    <v-card>
        <v-card-title class="grey lighten-3 headline">
            Employees Directory
        </v-card-title>
        <v-layout
                justify-space-between
                pa-3
        >
            <v-flex xs4>
                <v-treeview
                        :active.sync="active"
                        :items="items"
                        :load-children="fetchUsers"
                        :open.sync="open"
                        activatable
                        active-class="primary--text"
                        open-on-click
                        transition
                >
                    <v-icon
                            v-if="!item.children"
                            slot="prepend"
                            slot-scope="{ item, active }"
                            :color="active ? 'primary' : ''"
                    >mdi-account</v-icon>
                </v-treeview>
            </v-flex>
            <v-flex
                    d-flex
                    text-xs-center
            >
                <v-scroll-y-transition mode="out-in">
                    <div
                            v-if="!selected"
                            class="title grey--text text--lighten-1 font-weight-light"
                            style="align-self: center;"
                    >
                        Select a Employee
                    </div>
                    <v-card
                            v-else
                            :key="selected.id"
                            class="pt-4 mx-auto"
                            flat
                            max-width="450"
                    >
                        <v-card-text>
                            <v-avatar
                                    v-if="avatar"
                                    size="88"
                            >
                                <v-img
                                        :src="`https://avataaars.io/${avatar}`"
                                        class="mb-4"
                                ></v-img>
                            </v-avatar>
                            <!--Name-->
                            <h3 class="headline mb-2">
                                {{ selected.name }}
                            </h3>
                            <!--Email-->
                            <div class="blue--text mb-2">{{ selected.email }}</div>
                            <!--Department|city-->
                            <div class="blue--text subheading font-weight-bold">{{ selected.department }} - {{ selected.city}}</div>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-layout
                                tag="v-card-text"
                                text-xs-left
                                wrap
                        >
                            <!--Salary-->
                            <v-flex tag="strong" xs5 text-xs-right mr-3 mb-2>Salary:</v-flex>
                            <v-flex>{{ selected.salary }} $</v-flex>
                            <!--Employment Date-->
                            <v-flex tag="strong" xs5 text-xs-right mr-3 mb-2>Employment Date:</v-flex>
                            <v-flex>{{ selected.employment_date }}</v-flex>
                            <!--Staff positions-->
                            <v-flex tag="strong" xs5 text-xs-right mr-3 mb-2>Staff positions:</v-flex>
                            <v-flex>
                                <span v-for="staffPosition in selected.staff_positions">{{ staffPosition }} </span>
                            </v-flex>
                            <!--Boss-->
                            <v-flex tag="strong" xs5 text-xs-right mr-3 mb-2>Boss:</v-flex>
                            <v-flex>
                                {{ boss.name }}
                            </v-flex>
                        </v-layout>
                    </v-card>
                </v-scroll-y-transition>
            </v-flex>
        </v-layout>
    </v-card>
</template>

<script>
    const avatars = [
        '?accessoriesType=Blank&avatarStyle=Circle&clotheColor=PastelGreen&clotheType=ShirtScoopNeck&eyeType=Wink&eyebrowType=UnibrowNatural&facialHairColor=Black&facialHairType=MoustacheMagnum&hairColor=Platinum&mouthType=Concerned&skinColor=Tanned&topType=Turban',
        '?accessoriesType=Sunglasses&avatarStyle=Circle&clotheColor=Gray02&clotheType=ShirtScoopNeck&eyeType=EyeRoll&eyebrowType=RaisedExcited&facialHairColor=Red&facialHairType=BeardMagestic&hairColor=Red&hatColor=White&mouthType=Twinkle&skinColor=DarkBrown&topType=LongHairBun',
        '?accessoriesType=Prescription02&avatarStyle=Circle&clotheColor=Black&clotheType=ShirtVNeck&eyeType=Surprised&eyebrowType=Angry&facialHairColor=Blonde&facialHairType=Blank&hairColor=Blonde&hatColor=PastelOrange&mouthType=Smile&skinColor=Black&topType=LongHairNotTooLong',
        '?accessoriesType=Round&avatarStyle=Circle&clotheColor=PastelOrange&clotheType=Overall&eyeType=Close&eyebrowType=AngryNatural&facialHairColor=Blonde&facialHairType=Blank&graphicType=Pizza&hairColor=Black&hatColor=PastelBlue&mouthType=Serious&skinColor=Light&topType=LongHairBigHair',
        '?accessoriesType=Kurt&avatarStyle=Circle&clotheColor=Gray01&clotheType=BlazerShirt&eyeType=Surprised&eyebrowType=Default&facialHairColor=Red&facialHairType=Blank&graphicType=Selena&hairColor=Red&hatColor=Blue02&mouthType=Twinkle&skinColor=Pale&topType=LongHairCurly'
    ]

    function findById(tree, id){
        if(tree.id == id){
            return tree;
        }else if (tree.children != null){
            let j;
            let result = null;
            for(j=0; result == null && j < tree.children.length; j++){
                result = findById(tree.children[j], id);
            }
            return result;
        }
        return null;
    }

    export default {
        data: () => ({
            active: [],
            avatar: null,
            open: [],
            macroRegions: [],
            //TODO:: recheck it i not sure it best option
            boss: '',
        }),
        computed: {
            items () {
                return [
                    {
                        name: 'Macro regions',
                        children: this.macroRegions
                    }
                ]
            },
            selected () {
                if (!this.active.length) return undefined
                let employeeId = this.active[0]
                let selected, result, i;

                //Find employee inside tree
                for(i=0; i<this.macroRegions.length; i++) {
                    result = findById(this.macroRegions[i], employeeId)
                    if (result)
                        selected = result
                }

                // Add boss data
                fetch('/api/employees/' + selected.boss_id)
                    .then(res => res.json())
                    .then(json => this.boss = json)
                    .catch(err => console.warn(err))
                return selected
            }
        },
        watch: {
            selected: 'randomAvatar'
        },
        methods: {
            async fetchUsers (item) {
                return fetch('/api/employees')
                    .then(res => res.json())
                    .then(json => item.children.push(...json))
                    .catch(err => console.warn(err))
            },
            randomAvatar () {
                this.avatar = avatars[Math.floor(Math.random() * avatars.length)]
            }
        }
    }
</script>