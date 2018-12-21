<div class="rating" >
    @for ($i = 0; $i < $product->rating->rating; $i++)
        <i class="fas fa-star"></i>
    @endfor
    @for ($i = $product->rating->rating; $i < 5; $i++)
        <i class="far fa-star"></i>
    @endfor
</div>
