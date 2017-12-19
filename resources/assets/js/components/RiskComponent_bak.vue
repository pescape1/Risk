<template>
        <tr v-if="!editing">
        	<td><span>{{ risk.risk }}</span><input type="hidden" name="risk1[]" :value="risk.risk"></td>
        	<td><span>{{ risk.detail }}</span><input type="hidden" name="detail1[]" :value="risk.detail"></td>
            <td>
                <a @click="edit">
                    <app-icon img="edit"></app-icon>
                </a>
                <a @click="remove">
                    <app-icon img="trash"></app-icon>
                </a>
            </td>
        </tr>
        <tr v-else>
            <td>
            	<input type="text" v-model="draftRisk" v-validate="'required'" name="risk">
                <li v-show="errors.has('risk')" class="text-danger">{{errors.first('risk')}}</li>
            </td>           
            <td>
            	<textarea v-model="draftDetail" v-validate="'required'" name="detail"></textarea>
                <li v-show="errors.has('detail')" class="text-danger">{{errors.first('detail')}}</li>
            </td>            
            <td>
                <a @click="update">
                    <app-icon img="ok"></app-icon>
                </a>
                <a @click="discard">
                    <app-icon img="remove"></app-icon>
                </a>
            </td>                        
        </tr>
</template>

<script>
    import EventBus from '../eventbus';
    export default {
	    data: function () {
	        return {
	            editing: false,
	            draftRisk: '',
	            draftDetail: ''
	        };
	    },
        props: ['risk', 'index'],
	    created: function () {
	        EventBus.$on('editing', function (index) {
	            if (this.index != index) {
	                console.log('Discarding: '+this.index);
	                this.discard();
	            }
	        }.bind(this));
		    EventBus.$on('resetEdit', function () {
                this.discard();
		        this.$validator.reset();
		    }.bind(this));	    
		},
	    methods: {
   	        edit: function () {
	            console.log('Editing ' + this.index);
	            EventBus.$emit('editing', this.index);
	            EventBus.$emit('resetNew');
	            this.draftRisk = this.risk.risk;
	            this.draftDetail = this.risk.detail;
	            this.editing = true;
	        },
	        update: function () {
	            this.$validator.validateAll();
	            if (!this.errors.any()) {
		            this.risk.risk = this.draftRisk;
		            this.risk.detail = this.draftDetail;
		            this.editing = false;
                    this.$validator.reset();
                    EventBus.$emit('activeNew');		        
                }
	        },
	        discard: function () {
	            this.editing = false;
                EventBus.$emit('activeNew');
   	        },
	        remove: function () {
	            this.editing = false;
  	            this.$emit('remove', this.index);
	        },
	    }
    }
</script>