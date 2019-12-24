<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Setting Collections</h2>
          </div>
          <table class="table card-table">
            <tbody>
              <tr v-for="(collection, index) in settingCollections" v-bind:key="collection.id">
                <td>{{ collection.settings_name }}</td>
                <td class="text-right" width="25%">
                  <div class="row">
                    <div class="col-sm-6">
                      <button
                        class="btn btn-danger btn-block"
                        @click.prevent="deleteCollection(index, collection.id)"
                      >Delete</button>
                    </div>
                    <div class="col-sm-6">
                      <button class="btn btn-warning btn-block" @click.prevent="loadSettings(collection.id)">Load</button>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      settingCollections: []
    };
  },
  mounted() {
    let baseUrl = "http://localhost:8000/settings/collections";
    this.axios.get(baseUrl).then(response => {
      this.settingCollections = response.data;
    });
  },
  methods: {
    deleteCollection: function(event, id) {
      let baseUrl = "http://localhost:8000/settings/collections/" + id;
      let loader = this.$loading.show({
        loader: "dots",
        color: "#5EABED",
        backgroundColor: "#000000"
      });
      this.axios.delete(baseUrl).then(response => {
        loader.hide();
        let toast = this.$toasted.show(response.data.message, {
          theme: "toasted-primary",
          position: "top-left",
          duration: 5000
        });
        if (response.data.status == "ok") {
          this.settingCollections.splice(event, 1);
        }
      });
    },
    loadSettings(id)
    {
      let baseUrl = "http://localhost:8000/settings/collections/" + id;

      let loader = this.$loading.show({
        loader: "dots",
        color: "#5EABED",
        backgroundColor: "#000000"
      });

      this.axios.get(baseUrl).then(response => {
        if(this.$localStorage.set("configData", response.data.config_data)){
          loader.hide();
          let toast = this.$toasted.show("Setting Loaded !", {
            theme: "toasted-primary",
            position: "top-left",
            duration: 5000
          });
         this.$router.push('/settings');
        }
      });
    }
  }
};
</script>
