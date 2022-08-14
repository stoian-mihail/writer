<aside>
    <div class="row justify-content-center text-center">
        <img src="{{asset('/images/mihail_soare.png')}}" class="img-fluid author_image_side" alt="">
    </div>
    <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-light rounded">
            <h4 class="fst-italic">Acesta sunt...</h4>
            <p class="mb-0">
                Sunt netemeinic în ceea ce scriu,<br>
                sunt orbul fără soartă, mortul viu,<br>
                zeroul nud și fără conștiință,<br>
                sunt virgula de după pocăință,<br>
                sunt talerul mai ușurel că pana,<br>
                sunt recea pușcărie din Doftana,<br>
                analfabetul gângav fără creier,<br>
                vioara ruptă cu arcusu-n greier<br>
                și sunt nedemnul fără preț la snop<br>
                vomat de marea strânsă-ntr-un prosop,<br>
                sunt profitor de aburi și de vise<br>
                scuipate de omizi prin paraclise,<br>
                sunt potlogar, tembel și derbedeu,<br>
                sunt ce vreți voi, dar sunt și Dumnezeu…</p>
        </div>
        <!-- Categories widget-->
        <div class="card mb-4">
            <div class="card-header">Categorii</div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @foreach ($categories as $category)
                    <li><a href="#!">{{$category->name}}</a></li>
                    @endforeach
                </ul>

            </div>
        </div>
        <!-- Side widget-->
        <div class="card mb-4">
            <div class="card-header">Carti publicate</div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    @foreach ($books as $book)
                    <li>
                        <a href="#!">
                            <img src="{{$book->photos()->first()->file_url}}" class="img-fluid book-thumb" alt="">
                            <h5>{{$book->prod_name}}</h5>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="p-4">
            <h4 class="fst-italic">Ma gasiti si pe...</h4>
            <ol class="list-unstyled">
                <li><a href="#">Facebook</a></li>
            </ol>
        </div>
    </div>
</aside>
