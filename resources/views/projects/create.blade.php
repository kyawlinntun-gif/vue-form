<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vue Form</title>

    {{-- Bulma CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
</head>

<body>

    <div id="app">
        <div class="columns mt-6">
            <div class="column"></div>
            <div class="column is-three-fifths">
                <form @submit.prevent="onSubmit()" @keydown="form.errors.clear($event.target.name)">
                    <div class="field">
                        <label class="label">Project Name</label>
                        <div class="control">
                            <input class="input" type="text" v-model="form.project_name" name="project_name">
                        </div>
                        <span class="help is-danger" v-if="form.errors.has('project_name')" v-text="form.errors.get('project_name')"></span>
                    </div>
    
                    <div class="field">
                        <label class="label">Project Description</label>
                        <div class="control">
                            <input class="input" type="text" v-model="form.project_description" name="project_description">
                        </div>
                        <span class="help is-danger" v-if="form.errors.has('project_description')" v-text="form.errors.get('project_description')"></span>
                    </div>
    
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-link" type="submit" :disabled="form.errors.any()">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="column"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
