<template>
<div class="content-body">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Dönem</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="example3_wrapper" class="dataTables_wrapper no-footer">
                        <div class="dataTables_length" id="example3_length"></div>
                        <div id="example3_filter" class="dataTables_filter">
                            <label>
                                Ara :<input type="search" class="ml-3" v-model="search" /></label>
                        </div>
                        <table id="example3" class="display dataTable no-footer" role="grid" aria-describedby="example3_info" style="width: 100% !important">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column descending" style="width: 35.25px">
                                        <a class="btn btn-primary shadow btn-xs sharp" v-if="!add" @click="add = true"><i class="fa fa-plus"></i></a>
                                        <a class="btn btn-primary shadow btn-xs sharp" v-else @click="add = false"><i class="fa fa-plus"></i></a>
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 172.734px">
                                        İsim Soyisim
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Education: activate to sort column ascending" style="width: 140.234px">
                                        Yıl
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Education: activate to sort column ascending" style="width: 140.234px">
                                        Durum
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Education: activate to sort column ascending" style="width: 140.234px">
                                        Kayıt Tarihi
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Education: activate to sort column ascending" style="width: 140.234px">
                                        İşlemler
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr role="row" class="odd" v-for="(item, index) in forms" :key="item.id" :index="index">
                                    <td class="sorting_1">
                                        <a href="#" class="btn btn-success shadow btn-xs sharp">{{ index + 1 }}</a>
                                    </td>
                                    <td>{{ item.name}}</td>

                                    <td>
                                        <a href="javascript:void(0);"><strong>{{
                                                    item.yil
                                                }}</strong></a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" v-if="item.opened && (item.opened !=null  || item.opened !='')"><strong @click="makeOpened(item.id)"> <a href="#" class="btn btn-success shadow btn-xs sharp">On</a></strong></a>
                                        <a href="javascript:void(0);" v-else><strong @click="makeOpened(item.id)"> <a href="#" class="btn btn-danger shadow btn-xs sharp" style="background: red">Of</a></strong></a>
                                    </td>
                                    <td>
                                        {{ item.created_at.slice(0, 10) }}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-primary shadow btn-xs sharp mr-1" @click="edit(index)"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger shadow btn-xs sharp" @click="removeT(item.id)"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" v-if="add">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Yeni Dönem Kaydı Ekle</h4>
            </div>
            <div class="card-body">
                    <div class="form-row">
                        <div class="col-sm-12 pb-3">
                           
                        </div>
                        <div class="col-md-12 d-flex flex-wrap">
                            <div class="col-sm-4 pb-3">
                                <select class="form-control" placeholder="City" v-model="form.name">

                                <option value="" selected>Dönem Adı</option>
                                        <option value="Güz">Güz</option>
                                        <option value="Bahar">Bahar</option>
                            </select>
                            </div>
                            <div class="col-sm-4 pb-3">
                              <select name="" v-model="form.yil" id="" class="form-control">ü
                                        <option value="">Yıl</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success pl-4 pr-4" @click="addFunc()">
                                Kaydet
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { required, email } from "vuelidate/lib/validators";

export default {
    data() {
        return {
            add: false,
            ad: "efe",
            forms: [],
            o_forms: [],
            search: "",
            edit_: true,
            form: {
                name: "",
                yil: "",
                opened: "",
            },
        };
    },
    validations() {
        return {
            form: {
                name: { required: required },
                yil: { required },
                opened: { required },
            },
        };
    },

    methods: {
        messageAlert(title, message, type) {
            const setting = {
                title: title,
                body: message,
                type: type,
            };
            this.$vToastify.success(setting);
        },
        messageDanger(message) {
            this.$vToastify.danger(message);
        },

        load() {
            axios.post("/takip/donem-data").then((response) => {
                this.forms = response.data;
                this.o_forms = response.data;
            });
        },
        fileUpload(e) {
            this.$set(this.form, "loadFile", e.target.files[0]);
        },

        edit(index) {
            this.form = this.forms[index];
            this.add = true;
        },
        removeT(id) {
            axios
                .post("/takip/donem-delete/" + id)
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
                    console.log(err);
                });
        },
        makeOpened(id) {
            const control = confirm("Dönemi aktif Dönem Yapmak İstediğinize emin misiniz ?");
            if (!control) {
                return;
            }
            axios
                .post("/takip/donem-active/" + id)
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
                    console.log(err);
                });
        },
      
        addFunc() {
            var formData = new FormData();

            formData.append("name", this.form.name);
            formData.append("yil", this.form.yil);
            if (this.form.id) {
                formData.append("id", this.form.id);
            }

            axios
                .post("/takip/donem-add", formData)
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", 'success');
                    this.add= false;
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", 'error');
                    console.log(err);
                });
        },
    },

    created() {
        this.load();
    },
    mounted() {},
    watch: {
        search: function () {
            this.forms = this.o_forms.filter((item) => {
                return item.name
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
    },
};
</script>
