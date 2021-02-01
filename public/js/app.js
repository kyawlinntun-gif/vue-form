class Errors {
    constructor()
    {
        this.errors = {};
    }

    has(field)
    {
        return this.errors.hasOwnProperty(field);
    }

    get(field)
    {
        if(this.errors[field])
        {
            return this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors;
    }

    clear(field) {
        if(field) {
            delete this.errors[field]
            return;
        };

        this.errors = {};
    }

    any()
    {
        return Object.keys(this.errors).length > 0;
    }
}

class Form {
    constructor(data)
    {
        this.originalData = data;

        for (let field in data)
        {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    data()
    {
        // let data = Object.assign({}, this);

        // delete data.originalData;
        // delete data.errors;

        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }

    submit(requestType, url)
    {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data())
                .then(response => {
                    this.onSuccess(response.data.project);

                    resolve(response.data.project);
                })
                .catch(errors => {
                    this.onFail(errors.response.data.errors);

                    reject(errors.response.data.errors);
                });
        });
    }

    onSuccess(response)
    {
        alert(response);

        this.reset();
    }

    onFail(errors)
    {
        this.errors.record(errors);
    }

    reset()
    {
        for (let field in this.originalData)
        {
            this[field] = '';
        }

        this.errors.clear();
    }
}

new Vue({
    el: '#app',
    data() {
        return {
            form: new Form({
                project_name: '',
                project_description: ''
            })
        }
    },
    methods: {
        onSubmit() {
            this.form.submit('post', '/projects')
                .then(response => console.log(response))
                .catch(errors => console.log(errors));
        }
    }
});