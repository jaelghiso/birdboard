<template>
    <modal name="new-project" classes="p-10 bg-card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">
            Let´s start something new
        </h1>
        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label
                            for="title"
                            class="text-default text-sm block mb-2"
                            >Title</label
                        >
                        <input
                            v-model="form.title"
                            type="text"
                            id="title"
                            class="bg-card border border-muted-light text-sm text-muted py-2 px-2 block w-full rounded"
                            :class="form.errors.title ? 'border-red-600' : ''"
                        />
                        <span
                            class="text-xs text-red-600"
                            v-if="form.errors.title"
                            v-text="form.errors.title[0]"
                        ></span>
                    </div>
                    <div class="mb-4">
                        <label
                            for="description"
                            class="text-default text-sm block mb-2"
                            >Description</label
                        >
                        <textarea
                            v-model="form.description"
                            rows="6"
                            id="description"
                            class="bg-card border border-muted-light text-sm text-muted py-2 px-2 block w-full rounded"
                            :class="
                                form.errors.description ? 'border-red-600' : ''
                            "
                        ></textarea>
                        <span
                            class="text-xs text-red-600"
                            v-if="form.errors.description"
                            v-text="form.errors.description[0]"
                        ></span>
                    </div>
                </div>
                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="text-default text-sm block mb-2"
                            >Needs some tasks?</label
                        >
                        <input
                            v-for="task in form.tasks"
                            v-model="task.body"
                            :key="task.id"
                            type="text"
                            class="bg-card border border-muted-light text-sm text-muted mb-2 py-2 px-2 block w-full rounded"
                            placeholder="Task 1"
                        />
                    </div>
                    <button
                        type="button"
                        class="inline-flex items-center"
                        @click="addTask"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            viewBox="0 0 18 18"
                            class="mr-2"
                        >
                            <g fill="none" fill-rule="evenodd" opacity=".307">
                                <path
                                    stroke="#000"
                                    stroke-opacity=".012"
                                    stroke-width="0"
                                    d="M-3-3h24v24H-3z"
                                ></path>
                                <path
                                    fill="#000"
                                    d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z"
                                ></path>
                            </g>
                        </svg>
                        <span class="text-xs text-muted"
                            >Add new task field
                        </span>
                    </button>
                </div>
            </div>
            <footer class="flex justify-end">
                <button
                    type="button"
                    class="button is-outlined mr-4"
                    @click.prevent="$modal.hide('new-project')"
                >
                    Cancel
                </button>
                <button class="button">Create Project</button>
            </footer>
        </form>
    </modal>
</template>
<script>
import BirdboardForm from "./BirdboardForm.js";

export default {
    data() {
        return {
            form: new BirdboardForm({
                title: "",
                description: "",
                tasks: [{ body: "" }]
            })
        };
    },
    methods: {
        addTask() {
            this.form.tasks.push({ body: "" });
        },
        async submit() {
            if (!this.form.tasks[0].body) {
                delete this.form.originalData.tasks;
            }
            this.form
                .submit("/projects")
                .then(response => (location = response.data.message));
        }
    }
};
</script>
