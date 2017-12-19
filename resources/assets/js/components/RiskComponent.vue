<template>
	<div>
    <div class="form-group col-sm-12"><strong>Lista de Riesgos</strong></div>
    <div class="form-group col-sm-12">
    <table class="table table-responsive">
        <thead>
            <tr>
                <th class="col_risk">Risks</th>
                <th class="col_detail">Details</th>
                <th class="col_options">Options</th>
            </tr>
        </thead>
        <tbody>
        	<tr v-if="!risks.length">
        		<td colspan="12">No hay riesgos registrados.</td>
        	</tr>
            <tr v-for="(risk, index) in risks">
		        <template v-if="index==editing">
		            <td>
		            	<input type="text" v-model="input_risk" v-validate="{ required: true, unique_risk: [risks, index] }" class="input_risk" name="input_risk">
		                <li v-show="errors.has('input_risk')" class="text-danger">{{errors.first('input_risk')}}</li>
		            </td>           
		            <td>
		            	<textarea v-model="input_detail" v-validate="'required'" class="input_risk" name="input_detail"></textarea>
		                <li v-show="errors.has('input_detail')" class="text-danger">{{errors.first('input_detail')}}</li>
		            </td>            
		            <td>
		                <a @click="update(risk)">
		                    <app-icon img="ok" clase="text-success"></app-icon>
		                </a>
		                <a @click="discard">
		                    <app-icon img="remove" clase="text-danger"></app-icon>
		                </a>
		            </td>                        
		        </template>
		        <template v-else>
		        	<td><span>{{ risk.risk }}</span><input type="hidden" name="risk[]" :value="risk.risk"></td>
		        	<td><span>{{ risk.detail }}</span><input type="hidden" name="detail[]" :value="risk.detail"></td>
		            <td>
		                <a @click="edit(risk, index)">
		                    <app-icon img="edit"></app-icon>
		                </a>
		                <a @click="deleteRisk(index)">
		                    <app-icon img="trash"></app-icon>
		                </a>
		            </td>
		        </template>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <span @click.prevent="createRisk" class="btn btn-primary" :disabled="editing>=0">Add Risk</span>
                </td>
            </tr>
        </tfoot>
    </table>
    </div>
    </div>
</template>

<script>
    export default {
    	props: ['old','btn_save'],
	    data: function () {
	        return {
		        input_risk: '',
		        input_detail: '',
		        editing: -1,
		        adding: false,
		        risks: [],
	        };
	    },
		created: function () {
	   		var $old=$.parseJSON(this.old);
 	   		if($old['risk']!=undefined) {
   	   	   		var $i;
   	   	   		for($i=0; $i<$old['risk'].length;$i++) {
   	   	   			this.risks.push({
   	   	   				risk: $old['risk'][$i],
   	   	   				detail: $old['detail'][$i]
   	   	   			});
   	   	   		}
   	   	   	}
            if(typeof risks != 'undefined') Vue.set(this.$data, 'risks', risks);
		},	
        methods: {
	        createRisk: function () {
	            if(this.editing<0) {
			        this.input_risk = '',
			        this.input_detail = '',
                    this.risks.push({
                        risk: this.input_risk,
                        detail: this.input_detail,
                    });
                    this.editing=this.risks.length-1;
                    this.adding=true;
     	            $(this.btn_save).prop('disabled', true);
	            }
	        },
	        deleteRisk: function (index) {
	            if(this.editing<0) {
	                this.risks.splice(index, 1);
	            }
	        },
   	        edit: function (risk, index) {
	            if(this.editing<0) {
		            this.input_risk = risk.risk;
		            this.input_detail = risk.detail;
     	            this.editing = index;
     	            $(this.btn_save).prop('disabled', true);
		        }
	        },
	        update: function (risk) {
	            this.$validator.validateAll();
	            if (!this.errors.any()) {
		            risk.risk = this.input_risk;
		            risk.detail = this.input_detail;
		            this.editing = -1;
		            this.adding=false;
                    this.$validator.reset();
     	            $(this.btn_save).prop('disabled', false);
                }
	        },
	        discard: function () {
	        	if(this.adding) {
	        		this.risks.pop();
	        		this.adding=false;
	        	}
	            this.editing = -1;
 	            $(this.btn_save).prop('disabled', false);
   	        },
	    }
    }
</script>
<style scoped>
    .input_risk {
    	width: 100%;
    }
    .input_detail {
    	width: 100%;
    }
	.col_risk {
		width: 30%;
	}
	.col_detail {
		width: 50%;
	}
	.col_options {
		width: 20%;
	}
</style>