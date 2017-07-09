<template>
    <div>
        <div class="card mt-4" v-for="petition of petitions" v-if="petitions && petitions.length">
            <div class="card-block d-flex align-items-start flex-column">
                <h5 class="card-title">{{ petition.name }}</h5>
                <p class="card-text">
                    {{ petition.description.substring(0, 100) + '...' }}
                </p>
                <router-link class="btn bg-primary btn-block text-white mt-auto" :to="{ name: 'petition', params: { id: petition.id }}">
                    Sign this petition
                </router-link>
            </div>
        </div>
        <div v-else>
            No petitions created
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data: () => ({
            petitions: []
        }),
        computed: {
            summarizeDescription: function(string) {
                return string.substring(0, string) + '...';
            }
        },
        // Fetches petitions when the component is created.
        created() {
            axios.get(`/api/petitions`)
                .then(response => {
                    // JSON responses are automatically parsed.
                    this.petitions = response.data
                })
                .catch(e => {
                    this.errors.push(e)
                })
        }
    }
</script>
