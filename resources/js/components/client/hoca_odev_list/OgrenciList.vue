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
                                Ara :<input type="search" class="ml-3" v-model="search" placeholder="Başlık" /></label>
                        </div>
                        <table id="datatable" class="table table-striped table-bordered" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="max-width: 100px">#</th>
                                    <th>İsim Soyisim</th>
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th>Sınıf</th>
                                    <th>Öğrenci No</th>
                                    <th>Proje Başlığı</th>
                                    <th>Proje Durumu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in forms" :key="item.id" :index="index">
                                    <td style="width: 150px !important">
                                        <i class="fa fa-eye" style="
                                                    font-size: 20px;
                                                    cursor: pointer;
                                                " @click="seenUser(index)" title="Kişiye Ait Ödev detaylarını Görmek için tıklayınız"></i>
                                    </td>
                                    <td>{{ item.ad + item.soyad }}</td>
                                    <td>{{ item.eposta }}</td>
                                    <td>
                                        {{
                                                item.person && item.person.cep
                                                    ? item.person.cep
                                                    : ""
                                            }}
                                    </td>
                                    <td>
                                        {{
                                                item.person && item.person.sinif
                                                    ? item.person.sinif
                                                    : ""
                                            }}
                                    </td>
                                    <td>
                                        {{
                                                item.person &&
                                                item.person.ogrenciNo
                                                    ? item.person.ogrenciNo
                                                    : ""
                                            }}
                                    </td>

                                    <!-- <td>{{item.eposta}}</td> -->

                                    <!-- <td>{{(item.unvan == 'sistem-yoneticisi') ? 'Sistem Yöneticisi':((item.unvan =='proje-ogrencisi') ? 'Proje Öğrencisi' :(item.unvan =='proje-yurutucusu') ? 'Proje Yürütücüsü' : '') }}</td> -->
                                    <td>
                                        {{
                                                item.get_projects.length > 0
                                                    ? item.get_projects[
                                                          item.get_projects
                                                              .length - 1
                                                      ].baslik
                                                    : ""
                                            }}
                                    </td>
                                    <td>
                                        {{
                                                item.get_projects.length > 0
                                                    ? item.get_projects[
                                                          item.get_projects
                                                              .length - 1
                                                      ].durum
                                                    : ""
                                            }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" v-if="project_user">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    kİŞİ
                    <span class="badge badge-xs light badge-primary">Sağ taraftan önizlemesini kontrol edebilirsiniz
                    </span>
                </h4>
            </div>
            <div class="card-body">
                <table id="example3" class="display dataTable no-footer" role="grid" aria-describedby="example3_info" style="width: 100% !important">
                    <thead>
                        <tr>
                            <th style="max-width: 40px !important">
                                Öneri
                            </th>
                            <th style="max-width: 100px">Rapor</th>
                            <th style="max-width: 100px">Tez</th>
                            <th>Başlık</th>
                            <th>Anahtar Kelime</th>
                            <th>Proje Durumu</th>
                            <th>Görülme Durumu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 80px !important">
                                <a class="btn btn-primary shadow btn-xs sharp mr-1">
                                    <i class="fa fa-file" style="cursor: pointer" @click="edit(index)" title="Detayları Görmek için tıklayınız"></i></a>
                            </td>
                            <td style="width: 80px !important">
                                <a class="btn btn-primary shadow btn-xs sharp mr-1">
                                    <i class="fa fa-file" style="cursor: pointer" @click="edit2(index)" title="Detayları Görmek için tıklayınız"></i></a>
                            </td>
                            <td style="width: 80px !important">
                                <a class="btn btn-primary shadow btn-xs sharp mr-1">
                                    <i class="fa fa-file" style="cursor: pointer" @click="edit3(index)" title="Detayları Görmek için tıklayınız"></i></a>
                            </td>
                            <td>{{ project.baslik }}</td>
                            <td class="d-flex flex-wrap">
                                <span class="badge badge-m light badge-primary">{{ project.anahtar_kelime }}</span>
                            </td>
                            <td>{{ project.durum }}</td>
                            <td>
                                {{
                                        project.seen
                                            ? project.seen
                                            : "Görülmedi"
                                    }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12" v-if="oneri">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Proje Önerisi Formu
                    <span class="badge badge-xs light badge-primary">Sağ taraftan projenin önizlemesini kontrol
                        edebilirsiniz
                    </span>
                </h4>
            </div>
            <div class="card-body">
                <form action="" class="d-flex" @submit.prevent="onSubmit()">
                    <div class="col-md-8" style="overflow-y: scroll; max-height: 600px">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">
                                    <strong> Proje Başlığı:</strong></label>
                                <p>{{ project.baslik }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>
                                        Proje Anahtar Kelime
                                    </strong></label>
                                <br />
                                <span class="badge badge-m light badge-primary">{{ project.anahtar_kelime }}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>
                                        Projenin amacını, önemini ve
                                        Kapsamı</strong></label>
                                <p>{{ project.amac }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>
                                        Materyal, yöntem ve araştırma
                                        olanaklarını açıklayınız
                                    </strong></label>
                                <p>{{ project.metaryel }}</p>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="project.durum == 'Red Edildi'">
                            <div class="form-group">
                                <label for=""><strong> Red Nedeni </strong>
                                </label>
                                <p>{{ project.red_nedeni }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <textarea name="" id="" cols="30" rows="10" class="form-control" v-model="red_nedeni" v-if="red_nedeni"></textarea>
                        <div v-if="project.durum != 'Red Edildi'">
                            <button type="button" class="btn btn-success" @click="onay()">
                                Onayla
                            </button>
                            <button type="button" class="btn btn-danger" @click="red()" v-if="!red_nedeni">
                                Red Et
                            </button>
                            <button type="button" class="btn btn-danger" @click="red2()" v-else>
                                Red Et
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12" v-if="rapor">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rapor Aşaması</h4>
            </div>
            <div class="card-body">
                <form action="" class="d-flex fex-wrap" @submit.prevent="onSubmit()">
                    <div class="col-md-6 pt-5 pb-5" v-if="project.rapor_pdf">
                        <div class="col-md-12">
                            <a :href="'/public/files/' + project.rapor_word" class="alert alert-success alert-dismissible" role="alert" download="">
                                <strong></strong>Yüklenen Raporu İndirmek
                                İçin
                            </a>
                        </div>
                        <div class="col-md-12 pt-5">
                            <a :href="'/public/files/' + project.rapor_word2" class="alert alert-success alert-dismissible" role="alert" download="">
                                <strong></strong>Yüklenen Raporu İndirmek
                                İçin
                            </a>
                        </div>
                        <div class="col-md-12 pt-5">
                            <a :href="'/public/files/' + project.rapor_pdf" class="alert alert-success alert-dismissible" role="alert" download="">
                                <strong></strong>Yüklenen Raporu İndirmek
                                İçin
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12" v-if="project.durum == 'Rapor Red Edildi'">
                        <div class="form-group">
                            <label for="">Red Nedeni </label>
                            <textarea class="form-control" v-model="project.red_nedeni" rows="3" disabled></textarea>
                        </div>
                    </div>
                </form>
               <div class="col-md-4">
                        <textarea name="" id="" cols="30" rows="10" class="form-control" v-model="red_nedeni" v-if="red_nedeni"></textarea>
                        <div v-if="project.durum != 'Red Edildi'">
                            <button type="button" class="btn btn-success" @click="onay_rapor()">
                                Onayla
                            </button>
                            <button type="button" class="btn btn-danger" @click="red()" v-if="!red_nedeni">
                                Red Et
                            </button>
                            <button type="button" class="btn btn-danger" @click="rapor_red()" v-else>
                                Red Et
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" v-if="tez">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tez Aşaması</h4>
            </div>
            <div class="card-body">
                <form action="" class="d-flex fex-wrap" @submit.prevent="onSubmit()">
                    <div class="col-md-6 pt-5 pb-5" v-if="project.tez_pdf">
                        <div class="col-md-12">
                            <a :href="'/public/files/' + project.tez_word" class="alert alert-success alert-dismissible" role="alert" download="">
                                <strong></strong>Yüklenen Raporu İndirmek
                                İçin
                            </a>
                        </div>
                        <div class="col-md-12 pt-5">
                            <a :href="'/public/files/' + project.tez_word2" class="alert alert-success alert-dismissible" role="alert" download="">
                                <strong></strong>Yüklenen Raporu İndirmek
                                İçin
                            </a>
                        </div>
                        <div class="col-md-12 pt-5">
                            <a :href="'/public/files/' + project.tez_pdf" class="alert alert-success alert-dismissible" role="alert" download="">
                                <strong></strong>Yüklenen Raporu İndirmek
                                İçin
                            </a>
                        </div>
                    </div>
                    <div class="col-md-12" v-if="project.durum == 'Tez Red Edildi'">
                        <div class="form-group">
                            <label for="">Red Nedeni </label>
                            <textarea class="form-control" v-model="project.red_nedeni" rows="3" disabled></textarea>
                        </div>
                    </div>
                </form>
               <div class="col-md-4">
                        <textarea name="" id="" cols="30" rows="10" class="form-control" v-model="red_nedeni" v-if="red_nedeni"></textarea>
                        <div v-if="project.durum != 'Red Edildi'">
                            <button type="button" class="btn btn-success" @click="onay_tez()">
                                Onayla
                            </button>
                            <button type="button" class="btn btn-danger" @click="red()" v-if="!red_nedeni">
                                Red Et
                            </button>
                            <button type="button" class="btn btn-danger" @click="red_tez()" v-else>
                                Red Et
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
            ad: "efe",
            forms: [],
            o_forms: [],
            search: "",
            red_nedeni: false,
            edit_: true,
            project: {},
            form: {},
            project_user: false,
            oneri: false,
            rapor: false,
            tez: false,
            oneri_form: {},
        };
    },
    validations() {
        return {
            form: {},
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
        edit(index) {
            this.edit_projects(index);
            if (this.oneri) {
                this.oneri = false;
            } else {
                this.oneri = true;
            }
            this.editis = false;
        },
        edit2(index) {
            if (this.durum == "Devam Eden Proje") {
                this.messageAlert(
                    "Başarısız",
                    "Proje Henüz Rapor aşamasını geçemediği için bu kısım aktif değil",
                    "error"
                );
            } else {
                this.edit_rapor(index);
                if (this.rapor) {
                    this.rapor = false;
                } else {
                    this.rapor = true;
                }
            }
        },
        edit3(index) {
            if (
                this.project.durum == "Devam Eden Proje" ||
                this.project.durum.includes("Rapor")
            ) {
                this.messageAlert(
                    "Başarısız",
                    "Proje Henüz Tez aşamasını geçemediği için bu kısım aktif değil",
                    "error"
                );
            } else {
                this.edit_tez(index);
                if (this.tez) {
                    this.tez = false;
                } else {
                    this.tez = true;
                }
            }
        },
        seenUser(index) {
            this.project = this.forms[index].get_projects[0];
            if (this.project_user) {
                this.project_user = false;
            } else {
                this.project_user = true;
            }
        },
        red() {
            this.red_nedeni =
                "Proje'nin amacının tekrardan düzeltilmesi gerekliliğinden onaylayamadım. ";
        },
        red2() {
            var con1firm = confirm("Red Etmek istediğinize emin misiniz ?");
            if (!con1firm) {
                return;
            }
            axios
                .post("/takip/proje-revize/", {
                    id: this.project.id,
                    red_nedeni: this.red_nedeni,
                })
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
                    console.log(err);
                });
        },
        rapor_red() {
            var con1firm = confirm("Red Etmek istediğinize emin misiniz ?");
            if (!con1firm) {
                return;
            }
            axios
                .post("/takip/proje-rapor-red/", {
                    id: this.project.id,
                    red_nedeni: this.red_nedeni,
                })
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
                    console.log(err);
                });
        },
        red_tez() {
            var con1firm = confirm("Red Etmek istediğinize emin misiniz ?");
            if (!con1firm) {
                return;
            }
            axios
                .post("/takip/proje-tez-red/", {
                    id: this.project.id,
                    red_nedeni: this.red_nedeni,
                })
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
                    console.log(err);
                });
        },
        onay() {
            var con1firm = confirm("Onaylamak istediğinize emin misiniz ?");
            if (!con1firm) {
                return;
            }
            axios
                .post("/takip/proje-onay/", { id: this.project.id })
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
                    console.log(err);
                });
        },
        onay_rapor() {
            var con1firm = confirm("Onaylamak istediğinize emin misiniz ?");
            if (!con1firm) {
                return;
            }
            axios
                .post("/takip/proje-onay-rapor/", { id: this.project.id })
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
                    console.log(err);
                });
        },
        onay_tez() {
            var con1firm = confirm("Onaylamak istediğinize emin misiniz ?");
            if (!con1firm) {
                return;
            }
            axios
                .post("/takip/proje-onay-tez/", { id: this.project.id })
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
                    console.log(err);
                });
        },

        load() {
            axios.post("/takip/ogrenciler-data").then((response) => {
                this.forms = response.data;
                this.o_forms = response.data;
            });
        },
        fileUpload(e) {
            this.$set(this.form, "loadFile", e.target.files[0]);
        },

        edit_rapor(index) {
            axios
                .post("/takip/proje-seen-rapor/" + this.project.id)
                .then((response) => {
                    this.load();
                    this.project = this.form.get_projects[index];
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        edit_tez(index) {
      
            axios
                .post("/takip/proje-seen-tez/" + this.project.id)
                .then((response) => {
                    this.load();
                    this.project = this.form.get_projects[index];
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        edit_projects(index) {

            axios
                .post("/takip/proje-seen/" + this.project.id)
                .then((response) => {
                    this.load();
                    this.project = this.form.get_projects[index];
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        removeT(id) {
            axios
                .post("/takip/user-delete/" + id)
                .then((response) => {
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
                    console.log(err);
                });
        },
        add() {
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
                    this.messageAlert("Başarılı", "İşlem Başarılı", "success");
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız", "error");
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
                return item.unvan
                    .toLowerCase()
                    .includes(this.search.toLowerCase());
            });
        },
    },
};
</script>
