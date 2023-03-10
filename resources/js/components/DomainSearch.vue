<template>
    <div class="domain-search">
        <div class="form-group form-row justify-content-center">
            <b-col cols="6">
                <b-form-input v-model="keyName" :state="checkDomainPrefix()" aria-describedby="input-live-feedback"
                    placeholder="Kiểm tra tên miền" />
                <b-form-invalid-feedback id="input-live-feedback">Domain không hợp lệ</b-form-invalid-feedback>
            </b-col>
            <b-col cols="auto">
                <b-button variant="danger" :disabled="progress" @click="handleCheckDomain()">Kiểm tra</b-button>
            </b-col>
        </div>

        <div v-if="progress" class="d-flex justify-content-center">
            <div class="text-center">
                <b-spinner label="Loading..."></b-spinner>
                <div class="h3">Kiểm tra domain khả dụng. Vui lòng chờ</div>
            </div>
        </div>

        <div v-else-if="listData.length > 0" class="">
            <b-card :header="cardHeaderInfo.title" :header-bg-variant="cardHeaderInfo.variant" header-text-variant="white">
                <b-row v-for="item in primaryData" class="g-2">
                    <b-col>
                        <div class="d-flex justify-content-between">
                            <span>{{ item.domain }}</span>
                            <b-badge v-if="item.available" variant="danger" pill>{{ calculatorPromotion(item) }}</b-badge>
                        </div>
                    </b-col>
                    <b-col>
                        <div v-if="item.available" class="d-flex justify-content-between">
                            <div>
                                <div class="text-line-through">{{ fmtCurrencyByCountry(item.product.billing.old) }}</div>
                                <div>{{ fmtCurrencyByCountry(item.product.billing.price) }}/năm</div>
                            </div>
                            <b-button variant="primary" href="tel:0976112209">Liên hệ</b-button>
                        </div>
                        <div v-else class="h5">
                            Xin lỗi, ai đó đã mua tên miền này trước
                        </div>
                    </b-col>
                </b-row>
            </b-card>

            <p class="text-center h3">Kiểm tra các tên miền khác</p>
            <b-list-group>
                <b-list-group-item v-for="item in listData">
                    <b-row class="g-2">
                        <b-col>
                            <div class="d-flex justify-content-between">
                                <span>{{ item.domain }}</span>
                                <b-badge variant="danger" pill>{{ calculatorPromotion(item) }}</b-badge>
                            </div>
                        </b-col>
                        <b-col>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-line-through">{{ fmtCurrencyByCountry(item.product.billing.old) }}</div>
                                    <div>{{ fmtCurrencyByCountry(item.product.billing.price) }}/năm</div>
                                </div>
                                <b-button variant="primary" href="tel:0976112209">Liên hệ</b-button>
                            </div>
                        </b-col>
                    </b-row>
                </b-list-group-item>
            </b-list-group>

            <p class="text-center h3">Gợi ý các tên miền hay khác</p>
            <b-list-group>
                <b-list-group-item v-for="item in listSuggest">
                    <b-row class="g-2">
                        <b-col>
                            <div class="d-flex justify-content-between">
                                <span>{{ item.domain }}</span>
                                <b-badge variant="danger" pill>{{ calculatorPromotion(item) }}</b-badge>
                            </div>
                        </b-col>
                        <b-col>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="text-line-through">{{ fmtCurrencyByCountry(item.product.billing.old) }}</div>
                                    <div>{{ fmtCurrencyByCountry(item.product.billing.price) }}/năm</div>
                                </div>
                                <b-button variant="primary" href="tel:0976112209">Liên hệ</b-button>
                            </div>
                        </b-col>
                    </b-row>
                </b-list-group-item>
            </b-list-group>
        </div>
    </div>
</template>
  
<script>
import {head,reverse,split,includes,get,isNaN,isNil,toLower} from 'lodash';
export default {
    props: {
        baseUrl: String
    },
    data() {
        return {
            keyName: '',
            progress: false,
            lstPrefixDomain: ['com', 'online', 'net', 'shop', 'org', 'store', 'tech', 'xyz', 'cloud', 'site', 'website', 'blog', 'io', 'fun', 'art', 'click', 'top', 'icu', 'ai', 'pro'],
            primaryData: [],
            listData: [],
            listSuggest: []
        }
    },
    created() {
        axios.defaults.baseURL = this.baseUrl;
    },
    computed: {
        cardHeaderInfo() {
            if (!head(this.primaryData).available) {
                return {
                    title: 'Domain đã bị mua trước',
                    variant: 'danger'
                }
            } else {
                return {
                    title: 'Domain khả dụng',
                    variant: 'primary'
                }
            }
        },
    },
    methods: {
        checkDomainPrefix() {
            if (this.keyName === '') return null;
            else if (this.keyName.length <= 2) return false;
            const arrs = reverse(split(this.keyName, '.'));
            const key = arrs.length === 1 ? 'com' : arrs[0];
            return includes(this.lstPrefixDomain, key);
        },
        async handleCheckDomain() {
            if (this.checkDomainPrefix()) {
                this.progress = true;
                await this.searchDomain()
            } else {
                return null
            }
        },
        async searchDomain() {
            await axios.post('domain-search', {
                key: this.keyName
            }).then((res) => {
                this.progress = false;
                this.primaryData = res.data.data.available;
                this.listData = res.data.data.populars;
                this.listSuggest = res.data.data.suggest;
            });
        },
        calculatorPromotion(item) {
            let percent = 100 - Math.round((item.product.billing.price / item.product.billing.old) * 100)
            return 'Giảm ' + percent + '%'
        },
        getCountryCurrency(country) {
            const lstCurrencyCountry = {
                id: { locale: 'id-ID', currency: 'IDR' },
                th: { locale: 'th-TH', currency: 'THB' },
                vn: { locale: 'vi-VN', currency: 'VND' },
                sg: { locale: 'zh-SG', currency: 'SGD' },
                my: { locale: 'ms-MY', currency: 'MYR' },
                ph: { locale: 'en-PH', currency: 'PHP' }
            };

            return get(lstCurrencyCountry, country);
        },
        fmtCurrencyByCountry(value, country = 'vn', defaultDecimal = 0) {
            if (isNil(value) || isNaN(value)) {
                return '--';
            }

            const currentCurrency = this.getCountryCurrency(toLower(country));

            let decimal = 0;
            if (defaultDecimal !== undefined && defaultDecimal !== null) {
                decimal = defaultDecimal;
            }

            const locale = currentCurrency.locale

            let formatValue = new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: currentCurrency.currency,
                minimumFractionDigits: decimal,
                maximumFractionDigits: decimal,
            }).format(value);

            if (currentCurrency.currency === 'VND') {
                formatValue = formatValue.split(',').map((item) => item.replaceAll('.', ',')).join('.')
            }

            return formatValue
        }
    }
}
</script>
  