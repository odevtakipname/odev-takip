<template>
<div class="content-body">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Kullanıcılar</h4>
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
                                        <a class="btn btn-primary shadow btn-xs sharp" v-if="!add" @click="add = true"><i class="fa fa-user-plus"></i></a>
                                        <a class="btn btn-primary shadow btn-xs sharp" v-else @click="add = false"><i class="fa fa-user-plus"></i></a>
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 172.734px">
                                        İsim Soyisim
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending" style="width: 208.234px">
                                        Kullanıcı Tipi
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="Gender: activate to sort column ascending" style="width: 76.6875px">
                                        E Posta
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
                                    <td>{{ item.ad + item.soyad }}</td>
                                    <td>
                                        {{
                                                item.unvan ==
                                                "sistem-yoneticisi"
                                                    ? "Sistem Yöneticisi"
                                                    : item.unvan ==
                                                      "proje-ogrencisi"
                                                    ? "Proje Öğrencisi"
                                                    : item.unvan ==
                                                      "proje-yurutucusu"
                                                    ? "Proje Yürütücüsü"
                                                    : ""
                                            }}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);"><strong>{{
                                                    item.eposta
                                                }}</strong></a>
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
                <h4 class="card-title">Kullanıcı Ekle Düzenle</h4>
            </div>
            <div class="card-body">
                <form method="POST" @submit.prevent="onSubmit">
                    <div class="form-row">
                        <div class="col-sm-12 pb-3">
                            <select class="form-control" placeholder="City" v-model="form.unvan">
                                <option value="">Kullanıcı Seçiniz</option>
                                <option value="sistem-yoneticisi">Sistem Kullanıcısı</option>
                                <option value="proje-yurutucusu">Proje Yürütücüsü</option>
                                <option value="proje-ogrencisi">Proje Öğrencisi</option>
                            </select>
                        </div>
                        <div class="col-md-12 d-flex flex-wrap">
                            <div class="col-sm-4 pb-3">
                                <input type="text" class="form-control" placeholder="Ad" v-model="form.ad" />
                            </div>
                            <div class="col-sm-4 pb-3 mt-2 mt-sm-0">
                                <input type="text" class="form-control" placeholder="Soyad" v-model="form.soyad" />
                            </div>
                            <div class="col-sm-4 pb-3 mt-2 mt-sm-0">
                                <input type="email" class="form-control" placeholder="Email" v-model="form.eposta" />
                            </div>
                        </div>
                        <div class="col-md-12 p-0 d-flex flex-wrap" v-if="form.unvan == 'proje-ogrencisi'">
                            <div class="col-sm-4 pb-3">
                                <input type="text" class="form-control" placeholder="Öğrenci No" v-model="form.person.ogrenciNo" />
                            </div>
                            <div class="col-sm-4 pb-3 mt-2 mt-sm-0">
                                <input type="text" class="form-control" placeholder="Fakülte" v-model="form.person.fakulte" />
                            </div>
                            <div class="col-sm-4 pb-3 mt-2 mt-sm-0">
                                <input type="text" class="form-control" placeholder="Bölüm" v-model="form.person.bolum" />
                            </div>
                            <div class="col-sm-4 pb-3">
                                <input type="text" class="form-control" placeholder="Sınıf" v-model="form.person.sinif" />
                            </div>
                            <div class="col-sm-4 pb-3 mt-2 mt-sm-0">
                                <input type="text" class="form-control" placeholder="Cep" v-model="form.person.cep" />
                            </div>
                            <div class="col-sm-4 pb-3 mt-2 mt-sm-0">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" @change="fileUpload($event)">
                                    <label class="custom-file-label">Fotoğraf</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-success pl-4 pr-4" @click="addFunc()">Kaydet</button>
                        </div>
                    </div>
                </form>
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
                unvan: "",
                ad: "",
                soyad: "",
                eposta: "",
                person: {
                    ogrenciNo: "",
                    fakulte: "",
                    bolum: "",
                    sinif: "",
                    cep: "",
                    image: "",
                },
            },
        };
    },
    validations() {
        return {
            form: {
                ad: { required: required },
                unvan: { required },
                soyad: { required },
                eposta: { required, email },
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
            axios.post("/takip/user-data").then((response) => {
                this.forms = response.data;
                this.o_forms = response.data;
            });
        },
        fileUpload(e) {
            this.$set(this.form, "loadFile", e.target.files[0]);
        },

        edit(index) {
            this.form = this.forms[index];
            this.add = true
        },
        removeT(id) {
            axios
                .post("/takip/user-delete/" + id)
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", 'success');
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", 'error');
                    console.log(err);
                });
        },
        addFunc() {
            var formData = new FormData();

            formData.append("ad", this.form.ad);
            formData.append("soyad", this.form.soyad);
            formData.append("eposta", this.form.eposta);
            formData.append("unvan", this.form.unvan);
            formData.append("bolum", this.form.person.bolum);
            formData.append("ogrenciNo", this.form.person.ogrenciNo);
            formData.append("cep", this.form.person.cep);
            formData.append("fakulte", this.form.person.fakulte);
            formData.append("sinif", this.form.person.sinif);
            if (this.form.id) {
                formData.append("id", this.form.id);
            }
            if (this.form.loadFile) {
                formData.append(
                    "image",
                    this.form.loadFile,
                    this.form.loadFile.name
                );
            }
            axios
                .post("/takip/user-add", formData)
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", 'success');
                    this.add = false;
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
                return item.ad
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
    },
};
</script>
