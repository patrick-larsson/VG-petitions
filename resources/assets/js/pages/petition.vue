<template>
    <div>
        <div class="card-deck">
            <div class="card">
                <div class="card-block">
                    <h5 class="card-title">{{ petition.name }}</h5>
                    <p class="card-text">
                        {{ petition.description }}
                    </p>
                </div>
            </div>
            <div class="card" v-if="!authenticated">
                <div class="card-block">
                    <div class="card-title"><h5>Do you agree?</h5></div>
                    <div class="card-text">
                        <form @submit.prevent="signPetition" @keydown="form.errors.clear($event.target.name)">
                            <input v-model="form.petition" type="hidden" name="petition" id="petition" value={{}} />

                            <div class="form-group row" :class="{ 'has-danger': form.errors.has('email') }">
                                <div class="col">
                                    <input v-model="form.email" type="text" name="email" placeholder="Email" id="email" class="form-control" />
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                            </div>

                            <div class="form-group row" :class="{ 'has-danger': form.errors.has('firstName') }">
                                <div class="col">
                                    <input v-model="form.firstName" type="text" name="firstName" placeholder="First name" id="firstName" class="form-control" />
                                    <has-error :form="form" field="firstName"></has-error>
                                </div>
                            </div>

                            <div class="form-group row" :class="{ 'has-danger': form.errors.has('lastName') }">
                                <div class="col">
                                    <input v-model="form.lastName" type="text" name="lastName" placeholder="Last name" id="lastName" class="form-control" />
                                    <has-error :form="form" field="lastName"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 col-lg-6">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="f" v-model="form.gender" />
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Female</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" value="m" v-model="form.gender" />
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Male</span>
                                    </label>
                                </div>
                                <div class="col-md-12 col-lg-6 text-lg-right">
                                    <button :disabled="form.busy" type="submit" class="btn btn-primary">
                                        <icon v-if="form.busy" :name="form.busy ? 'spinner' : ''"></icon>
                                        Sign it!
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><h5>Participants ({{ petition.petitions_entries && petition.petitions_entries.length }})</h5></li>
                <li v-for="petition_entry of petition.petitions_entries" v-if="petition.petitions_entries && petition.petitions_entries.length" class="list-group-item">
                    <ul class="list-unstyled" transition="flash">
                        <li>
                            First name: {{ petition_entry.first_name }}
                        </li>
                        <li>
                            Last name: {{ petition_entry.last_name }}
                        </li>
                        <li v-if="petition_entry.gender">
                            Gender: {{ petition_entry.gender == 'f' ? '&#9792;' : '&#9794;' }}
                        </li>
                        <li v-if="petition_entry.email">
                            Email: {{ petition_entry.email }}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import Form from 'vform'
    import { mapGetters } from 'vuex'

    export default {
        data: () => ({
            petition: {},
            form: new Form({
                petition: 0,
                email: '',
                firstName: '',
                lastName: '',
                gender: 'f',
            })
        }),
        computed: mapGetters({
            authenticated: 'authCheck'
        }),
        created() {
            this.form.petition = this.$route.params.id;
            axios.get('/api/petitions/' + this.$route.params.id)
                .then(response => {
                    this.petition = response.data
                })
                .catch(e => {
                    this.errors.push(e)
                })
        },
        methods: {
            signPetition() {
                this.form.post('/api/petitions')
                    .then(({ data }) => {
                        this.petition.petitions_entries.unshift({
                            first_name: data.first_name,
                            last_name: data.last_name,
                            email: data.email,
                            gender: data.gender,
                        });

                        this.$data.form = this.$options.data().form;
                        this.$data.form.petition = this.$route.params.id;
                    })
            }
        },
    }
</script>
