

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

<script>
    const cartDOM = document.querySelector('.cart');
    const cartOverlay = document.querySelector('.cart-overlay');
        function showcart(){
            cartOverlay.classList.add('transparentBcg');
            cartDOM.classList.add('showCart');
            }
       function hidecart(){
            cartOverlay.classList.remove('transparentBcg');
            cartDOM.classList.remove('showCart');
        }  
 </script>

<script >
  /* */
        
        function quantity_up(){
            var quantity = parseInt(document.getElementById('quantity').value, 10);
            quantity = isNaN(quantity) ? 0 : quantity;
           quantity++;
            document.getElementById('quantity').value = quantity;
            
        }

        function quantity_down(){
            var quantity = parseInt(document.getElementById('quantity').value, 10);
            if(quantity > 0){
                quantity--;
            document.getElementById('quantity').value = quantity;
            }
        
        }
        
            
        
  
</script>


<!--cart -->
</body>
</html>