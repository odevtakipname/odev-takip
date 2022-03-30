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
                                <button @click="edit(1)">Ekle</button>
                        </div>
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
                                <tr v-for="(item, index) in forms" :key="item.id" :index="index">
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
                                    <td>{{ item.baslik }}</td>
                                    <td class="d-flex flex-wrap">
                                        <span class="badge badge-m light badge-primary" v-for="(
    keyyy, index
) in item.anahtar_kelime.split(
    ' '
)" :key="index" :index="index">{{ keyyy }}</span>
                                    </td>
                                    <td>{{ item.durum }}</td>
                                    <td>
                                        {{
                                                item.seen
                                                    ? item.seen
                                                    : "Görülmedi"
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
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Proje Başlığı</label>
                                <input type="text" name="unvan" class="form-control" v-model="form.baslik" :class="[
    'form-control ',
    $v.form.baslik.$error ?
    'is-invalid' :
    '',
]" @input="$v.form.baslik.$touch()" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" :class="[
    lenght_anahtar_kelime == 5 ?
    'text-success' :
    'text-warning',
]">Proje Anahtar Kelime</label>
                                <input type="text" name="unvan" class="form-control" v-model="form.anahtar_kelime" placeholder="anahtar_kelime1 anahtar_kelime2 " />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" :class="[
    lenght_amac >= 200 ?
    'text-success' :
    'text-warning',
]">Projenin amacını, önemini ve kapsamını
                                    açıklayınız
                                </label>
                                <textarea class="form-control" v-model="form.amac" rows="7" placeholder="Proejnin amacaını en az 200 kelime ile anlatınız"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" :class="[
    lenght_metaryel >= 300 ?
    'text-success' :
    'text-warning',
]">Materyal, yöntem ve araştırma
                                    olanaklarını açıklayınız
                                </label>
                                <textarea class="form-control" v-model="form.metaryel" rows="7" placeholder="en az 300 kelime ile anlatınız"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="form.durum == 'Red Edildi'">
                            <div class="form-group">
                                <label for="">Red Nedeni </label>
                                <textarea class="form-control" v-model="form.red_nedeni" rows="3" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="overflow-y: scroll; max-height: 600px">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">
                                    <strong> Proje Başlığı:</strong></label>
                                <p>{{ form.baslik }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>
                                        Proje Anahtar Kelime
                                    </strong></label>
                                <br />
                                <span class="badge badge-m light badge-primary" v-for="(
    keyyy, index
) in form.anahtar_kelime.split(' ')" :key="index" :index="index">{{ keyyy }}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>
                                        Projenin amacını, önemini ve
                                        Kapsamı</strong></label>
                                <p>{{ form.amac }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>
                                        Materyal, yöntem ve araştırma
                                        olanaklarını açıklayınız
                                    </strong></label>
                                <p>{{ form.metaryel }}</p>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="form.durum == 'Red Edildi'">
                            <div class="form-group">
                                <label for=""><strong> Red Nedeni </strong>
                                </label>
                                <p>{{ form.red_nedeni }}</p>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- v-if="lenght_metaryel >= 300 &&
    lenght_amac >= 200 &&
    lenght_anahtar_kelime == 5 &&
    !$v.form.$anyError &&
    editis" -->
                <button type="button" class="btn btn-primary" @click="add()" >
                    Kaydet
                </button>
                <button type="button" class="btn btn-primary"  disabled>
                    Kaydet
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-12" v-if="rapor">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Rapor Aşaması
           
                </h4>
            </div>
            <div class="card-body">
             <form action="" class="d-flex fex-wrap" @submit.prevent="onSubmit()">

                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Proje Raporu *(doc/docx)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'projeDocs')" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Proje Raporu *(pdf)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'projePdf')" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Proje Raporu *(doc/docx)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'projeDocs2')" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pt-5 pb-5" v-if="form.rapor_pdf">
                            <div class="col-md-12 ">
                                <a :href="'/public/files/' + form.rapor_word" class="alert alert-success alert-dismissible" role="alert" download="">
                                    <strong></strong>Yüklenen Raporu
                                    İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-12 pt-5">
                                <a :href="'/public/files/' + form.rapor_word2" class="alert alert-success alert-dismissible" role="alert" download="">
                            
                                    <strong></strong>Yüklenen Raporu
                                    İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-12 pt-5">
                                <a :href="'/public/files/' + form.rapor_pdf" class="alert alert-success alert-dismissible" role="alert" download="">
                            
                                    <strong></strong>Yüklenen Raporu
                                    İndirmek İçin
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="form.durum == 'Rapor Red Edildi'">
                            <div class="form-group">
                                <label for="">Red Nedeni </label>
                                <textarea class="form-control" v-model="form.red_nedeni" rows="3" disabled></textarea>
                            </div>
                        </div>
                    </form>
                                <button type="button" class="btn btn-primary" @click="addRapor()">
                        Kaydet
                    </button>
            </div>
        </div>
    </div>
    <div class="col-md-12" v-if="tez" >
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Tez Aşaması
                    <span class="badge badge-xs light badge-primary">
                        edebilirsiniz
                    </span>
                </h4>
            </div>
            <div class="card-body">
               <form method="POST" @submit.prevent="onSubmit()">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tez Raporu *(doc/docx)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'tezDocs')" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tez Raporu *(pdf)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'tezPdf')" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Tez Raporu *(doc/docx)</label>
                                    <input type="file" class="form-control" @change="fileUpload($event, 'tezDocs2')" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pt-5 pb-5" v-if="form.tez_pdf">
                            <div class="col-md-4">
                                <a :href="'/public/files/' + form.tez_word" class="alert alert-success alert-dismissible" role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Raporu
                                    İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + form.tez_word2" class="alert alert-success alert-dismissible" role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Raporu
                                    İndirmek İçin
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a :href="'/public/files/' + form.tez_pdf" class="alert alert-success alert-dismissible" role="alert" download="">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Docs</strong>Yüklenen Raporu
                                    İndirmek İçin
                                </a>
                            </div>
                        </div>
                        <div class="col-md-12" v-if="form.durum == 'Tez Red Edildi'">
                            <div class="form-group">
                                <label for="">Red Nedeni </label>
                                <textarea class="form-control" v-model="form.red_nedeni" rows="3" disabled></textarea>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-primary" @click="addTez()">
                        Kaydet
                    </button>
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
            rapor: false,
            tez: false,
            oneri: false,
            forms: [],
            o_forms: [],
            durum: "",
            search: "",
            editis: true,
            lenght_amac: "",
            lenght_metaryel: "",
            lenght_anahtar_kelime: "",
            edit_: true,
            form: {
                baslik: "",
                amac: "",
                anahtar_kelime: "",
                metaryel: "",
            },
            form2: {
                denem: "",
            },
        };
    },
    validations() {
        return {
            form: {
                baslik: { required: required },
                amac: { required },
                anahtar_kelime: { required },
                metaryel: { required, email },
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
        removeT() {},
        load() {
            axios.post("/takip/proje-data").then((response) => {
                this.forms = response.data;
                this.durum = response.data[0].durum;
                this.o_forms = response.data;
            });
        },
        fileUpload(e, name) {
            this.$set(this.form, name, e.target.files[0]);
        },

        edit(index) {
            if (this.oneri) {
                this.oneri = false;
            } else {
                this.oneri = true;
            }
            this.form = this.o_forms[index];
            this.editis = false;
        },
        edit2(index) {
            if (this.durum == "Devam Eden Proje") {
                this.messageAlert(
                    "Başarısız",
                    "Proje Henüz Rapor aşamasını geçemediği için bu kısım aktif değil",
                    'error'
                );
            } else {
                this.form = this.o_forms[index];
                this.editis = false;
                if (this.rapor) {
                    this.rapor = false;
                } else {
                    this.rapor = true;
                }
            }
        },
        edit3(index) {
            if (
                this.durum == "Devam Eden Proje" ||
                this.durum.includes("Rapor") 
            ) {
                 this.messageAlert(
                    "Başarısız",
                    "Proje Henüz Tez aşamasını geçemediği için bu kısım aktif değil",
                    'error'
                );
            } else {
                this.form = this.o_forms[index];
                this.editis = false;
                if (this.tez) {
                    this.tez = false;
                } else {
                    this.tez = true;
                }
            }
        },
        add() {
            var formData = new FormData();

            formData.append("baslik", this.form.baslik);
            formData.append("amac", this.form.amac);
            formData.append("metaryel", this.form.metaryel);
            formData.append("anahtar_kelime", this.form.anahtar_kelime);

            axios
                .post("/takip/proje-add", formData)
                .then((response) => {
                    this.messageAlert(
                        "Başarılı",
                        "İşlem Başarılı Proje Danışman Onayına Gönderildi.",
                        "success"
                    );
                    this.load();
                    this.oneri = false;
                })
                .catch((err) => {
                    this.messageAlert(
                        "Başarısız",
                        "İşlem Başarısız.",
                        "success"
                    );
                    console.log(err);
                });
        },
        addRapor() {
            var formData = new FormData();

            formData.append("id", this.form.id);
            if (this.form.projeDocs) {
                formData.append(
                    "projeDocs",
                    this.form.projeDocs,
                    this.form.projeDocs.name
                );
            }
            if (this.form.projeDocs2) {
                formData.append(
                    "projeDocs2",
                    this.form.projeDocs2,
                    this.form.projeDocs2.name
                );
            }
            if (this.form.projePdf) {
                formData.append(
                    "projePdf",
                    this.form.projePdf,
                    this.form.projePdf.name
                );
            }

            axios
                .post("/takip/proje-rapor-add", formData)
                .then((response) => {
                    this.messageAlert(
                        "Başarılı",
                        "İşlem Başarılı Proje Danışman Onayına Gönderildi.",
                        'success'
                    );
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız",'error');
                    console.log(err);
                });
        },
        addTez() {
            var formData = new FormData();

            formData.append("id", this.form.id);
            if (this.form.tezDocs) {
                formData.append(
                    "tezDocs",
                    this.form.tezDocs,
                    this.form.tezDocs.name
                );
            }
            if (this.form.tezDocs2) {
                formData.append(
                    "tezDocs2",
                    this.form.tezDocs2,
                    this.form.tezDocs2.name
                );
            }
            if (this.form.tezPdf) {
                formData.append(
                    "tezPdf",
                    this.form.tezPdf,
                    this.form.tezPdf.name
                );
            }

            axios
                .post("/takip/proje-tez-add", formData)
                .then((response) => {
                    this.messageAlert(
                        "Başarılı",
                        "İşlem Başarılı Proje Danışman Onayına Gönderildi.",
                        'success'
                    );
                    this.load();
                })
                .catch((err) => {
                    this.messageAlert("Başarısız", "İşlem Başarısız",'error');
                    console.log(err);
                });
        },
    },
    created() {
        this.load();
    },
    mounted() {},
    watch: {
        "form.amac": function () {
            var k = this.form.amac;
            k = k.replace(/(^\s*) | (\s*$)/gi, "");
            k = k.replace(/[ ]{2,}/gi, " ");
            k = k.replace(/\n/, /"\n"/);
            return (this.lenght_amac = k.split(" ").length);
        },
        "form.anahtar_kelime": function () {
            var k = this.form.anahtar_kelime;
            k = k.replace(/(^\s*) | (\s*$)/gi, "");
            k = k.replace(/[ ]{2,}/gi, " ");
            k = k.replace(/\n/, /"\n"/);
            return (this.lenght_anahtar_kelime = k.split(" ").length);
        },
        "form.metaryel": function () {
            var k = this.form.metaryel;
            k = k.replace(/(^\s*) | (\s*$)/gi, "");
            k = k.replace(/[ ]{2,}/gi, " ");
            k = k.replace(/\n/, /"\n"/);
            return (this.lenght_metaryel = k.split(" ").length);
        },
    },
};
</script>
