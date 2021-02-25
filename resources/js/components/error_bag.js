class ErrorBag {
    constructor(errors = {}) {
        this.setErrors(errors);
    }

    hasErrors() {
        return !!this.keys.length;
    }

    get keys() {
        return Object.keys(this.errors);
    }

    hasError(key) {
        return this.keys.indexOf(key) > -1;
    }

    firstKey() {
        return this.keys[0];
    }

    first(key) {
        return this.errors[key] ? this.errors[key][0] : undefined;
    }

    setErrors(errors) {
        this.errors = errors;
    }

    clearAll() {
        this.setErrors({});
    }

    clear(key) {
        return delete this.errors[key];
    }
}

export default ErrorBag;