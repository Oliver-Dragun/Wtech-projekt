import "./bootstrap";

import Alpine from "alpinejs";
import axios from "axios";

window.Alpine = Alpine;

window.searchDropdown = function () {
    return {
        query: "",
        results: [],

        async fetchResults() {
            if (this.query.length < 1) {
                this.results = [];
                return;
            }

            try {
                const response = await axios.get("/search", {
                    params: { q: this.query },
                });
                this.results = response.data;
            } catch {
                this.results = [];
            }
        },
    };
};

Alpine.start();
