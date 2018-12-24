<div class="rating" >
    @for ($i = 0; $i < round($product->rating->rating); $i++)
        <i class="fas fa-star"></i>
    @endfor
    @for ($i = round($product->rating->rating); $i < 5; $i++)
        <i class="far fa-star"></i>
    @endfor
</div>
