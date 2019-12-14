(function(){
   // Range
   new JSR(['#jsrMin', '#jsrMax'], {
    sliders: 2,
    values: [5, 100],
    limit: {
      show: false
    },
    min: 5,
    labels: {
        minMax: false,
         formatter: (value) => {
              return value.toString() + '0 000 FCFA';
          }
    },
    log: 'info'
});
     // Range
   new JSR(['#m2-1', '#m2-2'], {
    sliders: 2,
    values: [5, 100],
    limit: {
      show: false
    },
    min: 5,
    labels: {
        minMax: false,
         formatter: (value) => {
              return value.toString() + ' m2';
          }
    },
    log: 'info'
});
  //fin
    document.addEventListener('DOMContentLoaded', () => {
// Get all "navbar-burger" elements
const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

// Check if there are any navbar burgers
if ($navbarBurgers.length > 0) {

// Add a click event on each of them
$navbarBurgers.forEach( el => {
el.addEventListener('click', () => {

// Get the target from the "data-target" attribute
const target = el.dataset.target;
const $target = document.getElementById(target);

// Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
el.classList.toggle('is-active');
$target.classList.toggle('is-active');

});
});
}

});
    // setup an "add a tag" link
    (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
      $notification = $delete.parentNode;
      $delete.addEventListener('click', () => {
        $notification.parentNode.removeChild($notification);
      });
    });
    lightGallery(document.getElementById('lightgallery'));
    $('.viewgal').on('click',function(){
      $("#gal").click()
      
    })
      // codes pour ajouter et supprimer des photos
    var $newLinkLi = $('.photogrphy')
    $collectionHolder = $("div.photographies");
     $collectionHolder.find('.photogrphy').each(function() {
       addTagFormDeleteLink($(this));
    });
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
     $(".addTagButton").on('click', function(e) {
        e.preventDefault()
          // add a new tag form (see next code block)
          addTagForm($collectionHolder, $newLinkLi);
      });
        //
          function addTagForm($collectionHolder, $newLinkLi) {
            // Get the data-prototype explained earlier
            var prototype = $collectionHolder.data('prototype');

            // get the new index
            var index = $collectionHolder.data('index');

            var newForm = prototype;
            // You need this only if you didn't set 'label' => false in your tags field in TaskType
            // Replace '__name__label__' in the prototype's HTML to
            // instead be a number based on how many items we have
            // newForm = newForm.replace(/__name__label__/g, index);

            // Replace '__name__' in the prototype's HTML to
            // instead be a number based on how many items we have
            newForm = newForm.replace(/__name__/g, index);

            // increase the index with one for the next item
            $collectionHolder.data('index', index + 1);

            // Display the form in the page in an li, before the "Add a tag" link li
            var $newFormLi = $(newForm);
            $newLinkLi.before($newFormLi);
            // ajouter un lien de supprimer de la nouvelle form li
              addTagFormDeleteLink($newFormLi);
          }
          function addTagFormDeleteLink($tagFormLi) {
            console.log( $tagFormLi)
          var $removeFormButton = $('<div class="buttons" style="margin-top:5px"><button class="button is-danger is-light is-small"" type="button">Supprimer la photo</button></div>');
           $tagFormLi.append($removeFormButton);

          $removeFormButton.on('click', function(e) {
              // remove the li for the tag form
              e.preventDefault()
             $tagFormLi.remove();
             $('.slide-ill').css('height', $('.col-publish').height() - $('.navbar').height() + 'px' )
          });
          $('.slide-ill').css('height', $('.col-publish').height() + $('.navbar').height() + 'px' )
      }
        //titi
     $("#toto").html($collectionHolder)
      
     var app = angular.module('myapp', ['ngSanitize'])
    app.controller('boxController', function($scope){
      $scope.plus = true
      $scope.vueplus = function() {
        $scope.plus == true ? $scope.plus = false: $scope.plus = true
        $('.checker').slideToggle()
      }
        var mailSending = `<div class="notification is-primary">
        <button class="delete"></button>
                Votre message a été bien envoyé !
      </div>`
      
        $('.btn-contact').on('click', function($e){
            $e.preventDefault()
            if($('#get_touch_Nom').val()=='') {
                $scope.nomBox = true
                $scope.$apply()
                return
            }
            if($('#get_touch_Prenom').val()=='') {
                $scope.prenomBox = true
                $scope.nomBox = false
                $scope.$apply()
                return
            }
            if($('#get_touch_Sujet').val()=='') {
                $scope.sujetBox = true
                $scope.prenomBox = false
                $scope.$apply()
                return
            }
            var email = $('#get_touch_Email').val()
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            let e = re.test(String(email).toLowerCase())
            if (e == false) {
                $scope.sujetBox = false
                $scope.mailBox = true
                $scope.$apply()
                return
            }
            if($('#get_touch_Message').val()=='') {
                $scope.messageBox = true
                $scope.mailBox = false
                $scope.$apply()
                return
            }
            $scope.messageBox = false
            $scope.sending = true;
            $scope.$apply()
            //envois
            var form = document.getElementById('formBox')
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/home");
            xhr.addEventListener('load', onRequestComplete, false);
            xhr.upload.addEventListener("load", onUploadComplete, false);
            xhr.upload.addEventListener("progress", onUploadProgress, false);
            setTimeout(function(){
                xhr.send(new FormData(form));
            }, 3000)
            
            function onRequestComplete() {
                 $('.status').html(mailSending)
                 $('#get_touch_Message, #get_touch_Email,#get_touch_Sujet,#get_touch_Prenom,#get_touch_Nom').val('')
                 $scope.succes = true
                 $scope.sending = false
                 $scope.$apply()
            }
            function onUploadComplete() {
            }
            function onUploadProgress() {
               console.log('en cours d\'upload...')
            }
            //fin
            
        })
    })
    
     .controller('formController', function($scope){
          $('.comment').on('click', function(e) {
              e.preventDefault()
              var form = $('form[name="form_comment"]').serialize()
              var titre = $(this).attr('titre')
              var id = $(this).attr('id')
              var link = `${titre}-${id}`
              console.log(link)
              $scope.alert = false
              if($("#form_comment_textes").val()== '') {
                  $scope.message = true
                  $scope.alert = true
                   $scope.$apply()
                  return
              }
              $scope.message = false
              if($("#form_comment_nom").val()== '') {
                  $scope.nom = true
                  $scope.alert = true
                   $scope.$apply()
                  return
              }
              $scope.nom = false
               if($("#form_comment_prenom").val()== '') {
                  $scope.prenom = true
                  $scope.alert = true
                   $scope.$apply()
                  return
              }
              $scope.prenom = false
               if($("#form_comment_email").val()== '') {
                  $scope.email = true
                  $scope.alert = true
                   $scope.$apply()
                  return
              }
              $scope.email = false
              if($("#form_comment_titre").val()== '') {
                  $scope.titre = true
                  $scope.alert = true
                   $scope.$apply()
                  return
              }
              $scope.titre = false
              $scope.alert = false
              $scope.send = true
              $scope.$apply()
              $("#form_comment_textes, #form_comment_titre,#form_comment_email,#form_comment_prenom, #form_comment_nom").val('')
              setTimeout(function(){
                $.ajax({
                  method: 'POST',
                  url:`${titre}-${id}`,
                  data: form
                }).done(function(data) {
                    $("#commentaires").prepend(data)
                     $scope.send = false
                      $scope.$apply()
                })
                }, 3000)
              
          })
         
    })
     .controller("publishController",function($scope){
     //  $('.file-input').on('change', function() {
        // var $container = $('div#appartement_photographies');
       //  var elm = $container.attr('data-prototype').replace(/__name__label__/g, 'Fichier n°')//.replace(/__name__/g,"index")
      //  console.log('eeh ',  $(elm))
      // })
          $scope.max = 3
          $scope.uncount = 10
          $(document).on('change', 'input[type="file"]', function(){
            var id = $(this).attr('id')
              var name = document.getElementById(id).files[0]
              console.log('nameee ', name, 'parent ', $(this).closest('.file-label'))
              $(this).closest('.has-name').find('.file-name').html(name.name)
          })
          $('.submited').on('click', function($e){
          $e.preventDefault()
           hauteur=$(".navbar").offset().top;
          var titre = $('#appartement_title').val()
          var adresse = $('#appartement_numero').val()
          var ville = $('#appartement_ville').val()
          var prix = $('#prix').val()
          console.log(titre.length)
          $scope.empty = `<div class='column is-12' ng-show='incomplet'>
              <div class='notification is-danger'>
                  <button class='delete'></button>
                      Remplissez les champs laissés en rouge / vide !
                  </div>
            </div>`
            $scope.incomplet =  false
          if(titre.length<= 4) {
            $scope.title = true
            $scope.incomplet = true
            $('html,body').animate({scrollTop:hauteur},1000);
            $('.slide-ill').css('height', $('.col-publish').height() + $('.navbar').height() + 'px' )
            $scope.$apply()
            return
          }
           $scope.incomplet = false
          if(adresse.length<= 0) {
            $scope.adresse = true
            $scope.incomplet = true
            $('html,body').animate({scrollTop:hauteur},1000);
            $('.slide-ill').css('height', $('.col-publish').height() + $('.navbar').height() + 'px' )
            $scope.$apply()
            return
          }
          if(adresse.length<= 0) {
            $scope.ville = true
            $scope.incomplet = true
            $('html,body').animate({scrollTop:hauteur},1000);
            $('.slide-ill').css('height', $('.col-publish').height() + $('.navbar').height() + 'px' )
            $scope.$apply()
            return
          }
          if(prix.length<= 0) {
            $scope.prix = true
            $scope.incomplet = true
            $('html,body').animate({scrollTop:hauteur},1000);
            $('.slide-ill').css('height', $('.col-publish').height() + $('.navbar').height() + 'px' )
            $scope.$apply()
            return
          }
          $('.slide-ill').css('height', $('.col-publish').height() + $('.navbar').height() + 'px' )
          $scope.incomplet = false
          $scope.prix = false
          $scope.ville = false
           $scope.adresse = false
           $scope.title = false
          $scope.$apply()
          $scope.send = true
         $form =  $('#form_person_edit')
         var formData = new FormData()
         var myform = document.getElementById("form_person_edit")
         //formData.append("appartement[imageFile]",  document.getElementById("appartement_imageFile").files[0])
         //formData.append("appartement", $('#form_person_edit').serialize())
         var xhr = new XMLHttpRequest();
          xhr.open("POST", "/publish");
          xhr.addEventListener('load', onRequestComplete, false);
          xhr.upload.addEventListener("load", onUploadComplete, false);
          xhr.upload.addEventListener("progress", onUploadProgress, false);
          xhr.send(new FormData(myform));
          function onRequestComplete() {
               $scope.send = false
               console.log('ok envoyé')
               $('html,body').animate({scrollTop:hauteur},1000);
               $scope.empty = `<div class='column is-12' ng-show='incomplet'>
              <div class='notification is-primary'>
                  <button class='delete'></button>
                      Votre annonce a été publié !
                  </div>
            </div>`
            $scope.incomplet =  true
             $scope.$apply()
          }
          function onUploadComplete() {
               console.log('upload terminé !')
          }
          function onUploadProgress() {
             console.log('en cours d\'upload...')
          }
      })
     })
      
    //
    var taged = new Array();
    $('#myType div:first-of-type, .mycat div:first-of-type, #form_Types div:first-of-type').css('display', 'grid')
    $('.slide-ill').css('height', $('.col-publish').height() + $('.navbar').height() + 'px' )
    $("#appartement_Category").select2()
    $('#appartement_Types, #form_Types').select2({
      maximumSelectionLength: 2
    }) 
    toto = null
      var $input = $('input[id=appartement_tags]')
          .tagify({
          whitelist : [
          ],
          maxTags: 5
      })
      .on('add', function(e, tagName){
          console.log('JQEURY EVENT: ', 'added', tagName)
          toto = tagName;
          taged.push(tagName.data.value)
          $('input[id=appartement_tags]').val(taged)
          $.ajax({
            url: "{{path('publish') }}",
            method: "POST",
            dataType: "JSON",
            data: {tag: taged}
          }).done(function(){

          }).fail(function(err){
              console.log('erreur ', err);
          })
      })
      .on('remove', function(e, tagName){
        console.log('JQEURY EVENT: ', 'remove', tagName)
        var index = tagName.index
        // recup l index
        taged.splice(index, 1)
        console.log('tagName ', taged)
      })
      .on('invalid', function(e, tagName) {
          console.log('JQEURY EVENT: ',"invalid", e, ' ', tagName);
      });
          var jqTagify = $input.data('tagify');
          $('.tags-jquery--removeAllBtn').on('click', 
          jqTagify.removeAllTags.bind(jqTagify)
          )
      })()