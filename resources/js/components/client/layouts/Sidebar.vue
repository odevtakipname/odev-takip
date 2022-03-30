<template>
<div>
    <div class="nav-header">
        <a class="brand-logo text-dark" style="font-size: 15px; color: #101010">
        <div class="svg" style="border-radius: 50%; background: #efefef; padding: 10px">
          <svg width="32" height="32" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" style="color: #101010 !important">
                <g clip-path="url(#clip2)">
                    <path d="M14.9993 7.49987C17.0704 7.49987 18.7493 5.82097 18.7493 3.74993C18.7493 1.6789 17.0704 0 14.9993 0C12.9283 0 11.2494 1.6789 11.2494 3.74993C11.2494 5.82097 12.9283 7.49987 14.9993 7.49987Z" fill="#ffcbdb"></path>
                    <path d="M22.2878 27.2871L17.6697 29.0191L19.9663 29.8803C20.9546 30.2473 22.021 29.7388 22.3804 28.7826C22.5718 28.2725 22.5152 27.7381 22.2878 27.2871Z" fill="#ffcbdb"></path>
                    <path d="M6.28312 20.7436C5.31545 20.3847 4.23328 20.8718 3.86895 21.8412C3.50549 22.8108 3.99715 23.891 4.96658 24.2554L6.98941 25.0139L12.3298 23.011L6.28312 20.7436Z" fill="#ffcbdb"></path>
                    <path d="M26.1303 21.8413C25.7659 20.8717 24.6838 20.3847 23.7162 20.7436L8.71647 26.3685C7.74692 26.7329 7.25532 27.8132 7.61878 28.7827C7.97813 29.7386 9.0443 30.2474 10.033 29.8804L25.0326 24.2555C26.0022 23.8911 26.4938 22.8108 26.1303 21.8413Z" fill="#ffcbdb"></path>
                    <path d="M28.1244 14.9997H23.6585L20.4268 8.53623C20.0909 7.86516 19.4077 7.48284 18.7036 7.49989L14.9993 7.49987L11.2954 7.49989C10.5914 7.48284 9.90912 7.86522 9.5725 8.53623L6.34077 14.9997H1.87494C0.83953 14.9997 0 15.8392 0 16.8746C0 17.9101 0.83953 18.7496 1.87494 18.7496H7.49981C8.21026 18.7496 8.85936 18.3486 9.177 17.7132L11.2497 13.5679V20.6038L14.9995 22.0099L18.7496 20.6034V13.5679L20.8222 17.7132C21.1399 18.3486 21.789 18.7496 22.4994 18.7496H28.1243C29.1597 18.7496 29.9992 17.9101 29.9992 16.8746C29.9992 15.8392 29.1598 14.9997 28.1244 14.9997Z" fill="#fff"></path>
                </g>
                <defs>
                    <clipPath id="clip2">
                        <rect width="30" height="30" fill="white"></rect>
                    </clipPath>
                </defs>
            </svg>
        
        </div>
          
           <span class="pl-3 dashboard_bar " style="color: #000; text-transform: uppercase"> Ödev Takip Sistemi</span> </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="dashboard_bar" style="font-size: 12px; color: green"> {{new Date().getDay()+' ' + month[new Date().getMonth()] + ' ' + new Date().getFullYear()+ ' - ' + hours}}</div>
                    </div>
                    <ul class="navbar-nav header-right">
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                <div class="header-info">
                                    <span class="text-black"><strong>{{user.ad + ' ' +user.soyad }}</strong></span>
                                    <p class="fs-12 mb-0">{{user.unvan }}</p>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="/takip/logout" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ml-2">Çıkış Yap </span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
    <div class="deznav">
        <div class="deznav-scroll">
            <ul class="metismenu" id="menu" v-if="user.unvan == 'sistem-yoneticisi'">
                <li>
                    <a class="ai-icon" href="/" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text text-uppercase">anasayfa</span>
                    </a>
                </li>
                <li>
                    <a class="ai-icon" href="/takip/users" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text text-uppercase">Kullanıcılar</span>
                    </a>
                </li>
                <li>
                    <a class="ai-icon" href="/takip/donem" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text text-uppercase">Dönem Kayıt İşlemleri</span>
                    </a>
                </li>
                <li>
                    <a class="ai-icon" href="/takip/ogrenciler" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text text-uppercase">Öğrenci Ödev Takibi</span>
                    </a>
                </li>
            </ul>
            <ul class="metismenu" id="menu" v-if="user.unvan == 'proje-ogrencisi'">
                <li>
                    <a class="ai-icon" href="/" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text text-uppercase">anasayfa</span>
                    </a>
                </li>
                <li>
                    <a class="ai-icon" href="/takip/proje" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text text-uppercase">Öğrenci Ödev Takibi</span>
                    </a>
                </li>
            </ul>
            <ul class="metismenu" id="menu" v-if="user.unvan == 'proje-yurutucusu'">
                <li>
                    <a class="ai-icon" href="/" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text text-uppercase">anasayfa</span>
                    </a>
                </li>
                <li>
                    <a class="ai-icon" href="/takip/ogrenciler" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text text-uppercase">Öğrenciler ve Ödev Takibi</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--**********************************
            Sidebar end
        ***********************************-->
</div>
</template>

<script>
export default {
    data() {
        return {
            user: [],
            month : {
                1: "Ocak",
                2: "Şubat",
                3: "Mart",
                4: "Nisan",
                5: "Mayıs",
                6: "Haziran",
                7: "Temmuz",
                8: "Ağustos",
                9: "Eylül",
                10: "Ekim",
                11: "Kasım",
                12: "Aralık",
            }, 
            hours:''
        };
    },
    methods: {
        load() {
            axios.post("/takip/online-user-data").then((response) => {
                this.user = response.data.user;
            });
        },
        getTime(){
            setInterval(() => {
                this.hours = new Date().getHours() + ':' +new Date().getMinutes()+ ':' + new Date().getSeconds();
            }, 1000);
        }
    },
    mounted() {
        this.load();
        this.getTime()
    },
};
</script>
