<script type="text/javascript">
	$(document).ready(function() {
		$("#select_risks").select2({
		    width: "100%",
		    placeholder: 'Riesgos pre-existentes...',
		    allowClear: true,
		    minimumInputLength: 0,
		    ajax: {
		        url: '{{ url("/listareq") }}',
		        dataType: 'json',
		        type: "GET",
		        quietMillis: 0,
		            data: function (params) {
		                return {
		                    q: params.term, // search term
		                    id: {{$version->documento_version_id}}
		                };
		            },
		            processResults: function (data, params) {
		            return {
		                results: $.map(data, function (item) {
		                    return {
		                        id: item.version_comentario_id,
		                        titulo: item.comentario,
		                        subtitulo: 'Por: '+item.name+' ('+item.fecha_hora+')',
		                    }
		                })
		            };
		         },
		         cache: true,
		    },
		    language: {
		        "noResults": function(){
		            return "No hay requerimientos pendientes por gestionar.";
		        }    
		    },
		    escapeMarkup: function (markup) { return markup; },
		    templateResult: formatDef,
		    templateSelection: formatDefSelection
		});

		function formatDef (repo) {
		    if (repo.loading) return repo.titulo;

		    var markup = "<div><strong>" + repo.titulo + "</strong></div><div>"+repo.subtitulo+"</div>";
		    return markup;
		}

		function formatDefSelection (repo) {
		    return repo.titulo || repo.text;
		}
	});
</script>