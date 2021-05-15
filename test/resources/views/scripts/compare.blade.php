<script type="text/javascript">
    view_compare();
       function delete_compare(id) {
           // alert(id);
           if(localStorage.getItem('compare') != null){
               var data = JSON.parse(localStorage.getItem('compare'));
               var index = data.findIndex(item => item.id === id);
               // alert(index);
               data.splice(index, 1);
               localStorage.setItem('compare', JSON.stringify(data));
               document.getElementById("row_compare" + id).remove();
           }
       }

       function view_compare(){
           if(localStorage.getItem('compare') != null){
               // alert('have value');
               var data = JSON.parse(localStorage.getItem('compare'));

               var i;

               for(i = 0; i < data.length; i++){
                   var id = data[i].id;
                   var name = data[i].name;
                   var price = data[i].price;
                   var image = data[i].image;
                   var url  = data[i].url;
                   var category = data[i].category;
                   var description = data[i].description;
                   $('#row_compare').append(`

                           <td id="row_compare`+ id +`" class="hover-compare-block">
                               <div class="card">
                                   <img width="100%" height="250px" src="`+ image +`" class="card-img-top" alt="...">
                                   <div class="card-body">
                                       <h4 class="card-title">`+ name.substr(0, 15) +`...</h4>
                                       <h5>Category: `+ category +`</h5>
                                       <p style="color: black;">Price: $ `+ price +`</p>
                                       <p style="color: black;">Description: `+ description.substr(0, 40) +`...</p>
                                       <a class="btn btn-primary" href="`+ url +`">Details</a>
                                       <a class="btn btn-warning" style="cursor: pointer;" onclick="delete_compare(`+id+`)">Delete</a>
                                   </div>
                               </div>
                           </td>
                   `);
               }
           }
       }


       function add_compare(product_id) {
           // $('#compare').modal();
           // alert(product_id);
           $('.modal-backdrop.fade.show').hide();
           document.getElementById('title-compare').innerHTML ='Comparison';
           var id = product_id;
           var name = document.getElementById('product_name_cart_'+id).value;
           var price = document.getElementById('product_price_cart_'+id).value;
           var image = document.getElementById('img_'+id).src;
           var description = document.getElementById('product_description_'+ id).value;
           var url = document.getElementById('product_detail_'+id).href;
           var category = document.getElementById('product_category_cart_'+id).value;
           var newItem ={
               'id': id,
               'name':name,
               'price':price,
               'image':image,
               'url':url,
               'category':category,
               'description':description
           }
           // alert(newItem);
           if(localStorage.getItem('compare') == null){
               localStorage.setItem('compare', `[]`);
           }

           var old_data = JSON.parse(localStorage.getItem('compare'));

           var matches = $.grep(old_data, function(obj){
               return obj.id == id;
           })

           if(matches.length){
               notyf.error('You have already choosen this items!!!');
           }else{
               if(old_data.length < 3){

                   old_data.push(newItem);

                   $('#row_compare').append(`
                       <td id="row_compare`+ id +`" class="hover-compare-block">
                               <div class="card" >
                                   <img width="100%" height="250px" src="`+ newItem.image +`" class="card-img-top" alt="...">
                                   <div class="card-body">
                                       <h4 class="card-title">`+ newItem.name.substr(0, 15) +`...</h4>
                                       <h5>Category: `+ newItem.category +`</h5>
                                       <p>Price: $ `+ newItem.price+`</p>
                                       <p>Description: `+ newItem.description.substr(0, 40) +`...</p>
                                       <a href="`+ newItem.url +`" class="btn btn-primary">Details</a>
                                       <a class="btn btn-warning" style="cursor: pointer;" onclick="delete_compare(`+id+`)">Delete</a>
                                   </div>
                               </div>
                           </td>
                   `);
               }else{
                   notyf.error('You just can compare 3 items!!!');
               }
           }
           localStorage.setItem('compare', JSON.stringify(old_data));

       }
</script>
