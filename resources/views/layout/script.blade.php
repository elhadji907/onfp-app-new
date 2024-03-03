<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> 
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{--   <!-- Core plugin JavaScript--> --}}
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

{{--  Custom scripts for all pages  --}}
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

{{--   <!-- Page level plugins --> --}}
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

{{--  <!-- Page level custom scripts --> --}}
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script src="{{ asset('dist/js/select2.min.js') }}"></script> 
  
<script type="text/javascript">

      $("#objet").select2({
            placeholder: "sélectionner un objet",
            allowClear: true
        });
</script>  
<script type="text/javascript">

      $("#employee").select2({
            placeholder: "choisir responsable",
            allowClear: true
        });
</script>  
<script type="text/javascript">

      $("#etablissements").select2({
            placeholder: "choisir établissement",
            allowClear: true
        });
</script>  
<script type="text/javascript">
      $("#convention").select2({
            placeholder: "choisir convention",
            allowClear: true
        });
</script>  
<script type="text/javascript">
      $("#activite").select2({
            placeholder: "choisir activité",
            allowClear: true
        });
</script>  
<script type="text/javascript">
      $("#filiere").select2({
            placeholder: "choisir filière",
            allowClear: true
        });
</script>  
<script type="text/javascript">
      $("#ingenieur_projet").select2({
            placeholder: "choisir ingénieur responsable",
            allowClear: true
        });
</script>  
<script type="text/javascript">
      $("#projet-sigle").select2({
            placeholder: "choisir sigle",
            allowClear: true
        });
</script>  
  
<script type="text/javascript">
      $("#classeur").select2({
            placeholder: "sélectionner un classeur",
            allowClear: true
        });
</script>  
<script type="text/javascript">
      $("#sexe").select2({
            placeholder: "sélectionner le sexe",
            allowClear: true
        });
</script>  
<script type="text/javascript">
      $("#projet").select2({
            placeholder: "sélectionner un projet",
            allowClear: true
        });
</script>
<script type="text/javascript">
      $("#ingenieur").select2({
            placeholder: "sélectionner un ingenieur",
            allowClear: true
        });
</script>
<script type="text/javascript">
  $("#matricule_emp").select2({
        placeholder: "sélectionner le matricule du responsable",
        allowClear: true
    });
</script>
<script type="text/javascript">
  $("#convention").select2({
        placeholder: "sélectionner la convention",
        allowClear: true
    });
</script>
<script type="text/javascript">
  $("#civilite").select2({
        placeholder: "sélectionner civilité",
        allowClear: true
    });
</script>  
<script type="text/javascript">
  $("#etude").select2({
        placeholder: "Niveau d'étude",
        allowClear: true
    });
</script>  
<script type="text/javascript">
  $("#region").select2({
        placeholder: "sélectionner region",
        allowClear: true
    });
</script>  
<script type="text/javascript">
  $("#module").select2({
        placeholder: "sélectionner module",
        allowClear: true
    });
</script>  
<script type="text/javascript">
  $("#commune").select2({
        placeholder: "sélectionner commune",
        allowClear: true
    });
</script>  
<script type="text/javascript">
  $("#laregion").select2({
        placeholder: "sélectionner la région",
        allowClear: true
    });
</script>  
<script type="text/javascript">

  $("#etablissements").select2({
        placeholder: "sélectionner établissement",
        allowClear: true
    });
</script>  
<script type="text/javascript">

  $("#scolarite").select2({
        placeholder: "sélectionner la scolarité",
        allowClear: true
    });
</script>  
<script type="text/javascript">

  $("#region_id").select2({
        placeholder: "sélectionner region",
        allowClear: true
    });
</script>  
<script type="text/javascript">

      $("#structure").select2({
            placeholder: "sélectionner une structure",
            allowClear: true
        });
</script>
<script type="text/javascript">

      $("#filierespecialite").select2({
            placeholder: "sélectionner une spécialité",
            allowClear: true
        });
</script>
<script type="text/javascript">
  
  $("#type_demande").select2({
        placeholder: "sélectionner type de demande",
        allowClear: true
    });
</script>

<script type="text/javascript">    
  $("#type_direction").select2({
        placeholder: "sélectionner type direction",
        allowClear: true
    });
</script>

<script type="text/javascript">    
  $("#module-ageroute").select2({
        placeholder: "sélectionner module de formation",
        language: "fr",
        allowClear: true,
        maximumSelectionLength: 3,
        language: {
          // You can find all of the options in the language files provided in the
          // build. They all must be functions that return the string that should be
          // displayed.
          maximumSelected: function (e) {
              var t = "Vous ne pouvez sélectionner que " + e.maximum + " modules";
              e.maximum != 1 && (t += "s");
              return t + ' - Mettez à niveau maintenant et sélectionnez plus';
          }
      }
    });
</script>
<script type="text/javascript">    
  $("#module-ageroute2").select2({
        placeholder: "sélectionner un 2ème module",
        language: "fr",
        allowClear: true,
        maximumSelectionLength: 3,
        language: {
          // You can find all of the options in the language files provided in the
          // build. They all must be functions that return the string that should be
          // displayed.
          maximumSelected: function (e) {
              var t = "Vous ne pouvez sélectionner que " + e.maximum + " modules";
              e.maximum != 1 && (t += "s");
              return t + ' - Mettez à niveau maintenant et sélectionnez plus';
          }
      }
    });
</script>
<script type="text/javascript">    
  $("#module-ageroute3").select2({
        placeholder: "sélectionner un 3ème module",
        language: "fr",
        allowClear: true,
        maximumSelectionLength: 3,
        language: {
          // You can find all of the options in the language files provided in the
          // build. They all must be functions that return the string that should be
          // displayed.
          maximumSelected: function (e) {
              var t = "Vous ne pouvez sélectionner que " + e.maximum + " modules";
              e.maximum != 1 && (t += "s");
              return t + ' - Mettez à niveau maintenant et sélectionnez plus';
          }
      }
    });
</script>

<script type="text/javascript">    
  $("#moduleup").select2();
</script>

<script type="text/javascript">    
  $("#regions_op").select2({
        placeholder: "sélectionner régions d'intervention",
        language: "fr",
        allowClear: true,
        maximumSelectionLength: 14
    });
</script>

<script type="text/javascript">    
  $("#modules_op").select2({
        placeholder: "sélectionner modules d'intervention",
        language: "fr",
        allowClear: true,
        maximumSelectionLength: 14
    });
</script>
<script type="text/javascript">
$("#secteur").select2({
      placeholder: "selectione un secteur",
      allowClear: true
  });
</script>
<script type="text/javascript">
$("#moduleageroute").select2({
      placeholder: "Choisir un module de formation",
      allowClear: true
  });
</script>
<script type="text/javascript">
$("#domaine").select2({
      placeholder: "sélectionner un domaine",
      allowClear: true
  });
</script>
<script type="text/javascript">
$("#type_structure").select2({
      placeholder: "sélectionner type de structure",
      allowClear: true
  });
</script>
<script type="text/javascript">
$("#types_formations").select2({
      placeholder: "sélectionner type de formation",
      allowClear: true
  });
</script>
<script type="text/javascript">
$("#operateur").select2({
      placeholder: "choix opérateur",
      allowClear: true
  });
</script>
{{--  <script type="text/javascript">
$("#operateur").select2({
      placeholder: "choisir opérateur",
      allowClear: true
  });
</script>  --}}

<script type="text/javascript">

  $("#direction").select2({
        placeholder: "sélectionner une direction ou un service",
        allowClear: true
    });
  $("#imputation").select2({
        placeholder: "sélectionner pour faire imputation",
        allowClear: true
    });
</script>
<script type="text/javascript">

  $("#fonction").select2({
        placeholder: "sélectionner la fonction",
        allowClear: true
    });
</script>
<script type="text/javascript">
  
    $("#categorie").select2({
          placeholder: "sélectionner la catégorie",
          allowClear: true
      });
</script>
<script type="text/javascript">
  $("#niveau").select2({
        placeholder: "sélectionner un niveau d'étude",
        allowClear: true
    });
</script>

<script type="text/javascript">
  $("#programme").select2({
        placeholder: "sélectionner un programme",
        allowClear: true
    });
</script>

<script type="text/javascript">
  $("#departement").select2({
        placeholder: "sélectionner un département",
        allowClear: true
    });
</script>

<script type="text/javascript">
  $("#typedemande").select2({
        placeholder: "sélectionner type de demande",
        allowClear: true
    });
</script>

<script type="text/javascript">
  
  $("#familiale").select2({
        placeholder: "Votre situation familiale",
        allowClear: true
    });
</script>
<script type="text/javascript">  
  $("#diplome").select2({
        placeholder: "Dernier diplôme académique",
        allowClear: true
    });
</script>
<script type="text/javascript">  
  $("#diplome_pros").select2({
        placeholder: "Dernier diplôme professionnel",
        allowClear: true
    });
</script>
<script type="text/javascript">  
  $("#role").select2({
        placeholder: "Roles",
        allowClear: true
    });
</script>
<script type="text/javascript">
  
  $("#professionnelle").select2({
        placeholder: "Votre situation professionnelle",
        allowClear: true
    });
</script>
<script type="text/javascript">
  
  $("#localite").select2({
        placeholder: "sélectionner localité",
        allowClear: true
    });
</script>
<script type="text/javascript">
  
  $("#zone").select2({
        placeholder: "sélectionner zone",
        allowClear: true
    });
</script>
<script type="text/javascript">
  
  $("#choixoperateur").select2({
        placeholder: "sélectionner choix opérateur",
        allowClear: true
    });
</script>
<script type="text/javascript">
  
  $("#type_operateur").select2({
        placeholder: "sélectionner type operateur",
        allowClear: true
    });
</script>

<script type="text/javascript">
  
  $("#statut").select2({
        placeholder: "sélectionner",
        allowClear: true
    });
</script>

<script>

  function ConfirmDelete()
  {
  var x = confirm("Etes-vous sûr que vous voulez supprimer ?");
  if (x)
    return true;
  else
    return false;
  }

</script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
  <script src="{{ asset('js/feather.min.js') }}"></script>
  <script>
      feather.replace()
  </script>
@stack('scripts')
@yield('javascripts')