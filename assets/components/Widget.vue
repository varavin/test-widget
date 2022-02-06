<template>
  <div>
    <p>Company name: {{ widgetData.companyName }}</p>
    <p>Current price: {{ formattedPrice }}</p>
    <p>Updated at: {{ formattedDateTime }}</p>
  </div>
</template>
<script lang="ts">
import {defineComponent} from 'vue';
import {WidgetDataDto} from '../models/WidgetDataDto';

export default defineComponent({
  name: 'Widget',
  props: {
    fetchInterval: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      widgetData: {companyName: '-', currentPrice: 0, updatedTs: 0} as WidgetDataDto,
    }
  },
  created() {
    this.fetchWidgetData();
  },
  computed: {
    formattedPrice(): string {
      if (this.widgetData.currentPrice === 0) {
        return '-';
      }
      return this.widgetData.currentPrice.toString();
    },
    formattedDateTime(): string {
      if (this.widgetData.updatedTs === 0) {
        return '-';
      }
      const updateTime = new Date(this.widgetData.updatedTs * 1000);
      return updateTime.toLocaleString();
    }
  },
  methods: {
    async request<TResponse>(url: string, config: RequestInit = {}): Promise<TResponse> {
      const response = await fetch(url, config);
      return await response.json();
    },
    async fetchWidgetData() {
      try {
        this.widgetData = await this.request<WidgetDataDto>('/api/widget_data');
      } catch (error) {
        console.log('An error has occurred while retrieving data:');
        console.log(error);
      }
      setTimeout(() => this.fetchWidgetData(), this.fetchInterval * 1000)
    },
  }
});
</script>