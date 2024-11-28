@extends('layouts.app')

@section('title', 'Matrícula Inclusión')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-4 mb-4">Matrícula General</h1>
            <p class="lead mb-4">El respeto es una actitud fundamental en nuestra sociedad, que abarca la igualdad de género,
                la inclusión y la interculturalidad. Implica reconocer y valorar la dignidad y los derechos de todas las personas,
                sin importar su género, discapacidad o origen cultural. A través del respeto, podemos construir relaciones equitativas,
                promoviendo la igualdad de oportunidades y el trato justo para todos. Respetar la igualdad de género implica desafiar los
                estereotipos y roles de género, permitiendo que cada persona desarrolle su potencial sin limitaciones impuestas. Respetar
                la inclusión implica eliminar las barreras y garantizar la participación plena de todas las personas en la sociedad. Y respetar
                la interculturalidad implica valorar y aprender de la diversidad cultural, promoviendo el diálogo y la convivencia pacífica entre
                diferentes culturas. A través del respeto, podemos construir una sociedad más justa, inclusiva y equitativa, donde todas las
                personas sean valoradas y respetadas en su individualidad y en su diversidad.</p>
        </div>
    </div>

    <div class="row mt-5">
        {{-- IGUALDAD --}}
        <div class="col-md-12">
            <h2 class="mb-4">Datos Generales</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Subsitemas</th>
                            <th scope="col">Hombres (H)</th>
                            <th scope="col">Mujeres (M)</th>
                            <th scope="col">Otros (O)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>UAEM</td>
                            <td>150</td>
                            <td>200</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>UTEZ</td>
                            <td>80</td>
                            <td>120</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>UPEMOR</td>
                            <td>40</td>
                            <td>60</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>ITZ</td>
                            <td>280</td>
                            <td>100</td>
                            <td>80</td>
                        </tr>
                        <tr>
                            <td>ITC</td>
                            <td>70</td>
                            <td>250</td>
                            <td>53</td>
                        </tr>
                        <tr>
                            <td>CENIDET</td>
                            <td>90</td>
                            <td>28</td>
                            <td>89</td>
                        </tr>
                        <tr>
                            <td>UPN</td>
                            <td>27</td>
                            <td>98</td>
                            <td>4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- INCLUSIÓN --}}
        <div class="col-md-12">
            <h2 class="mb-4">Datos Generales</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Subsistemas (S)</th>
                            <th scope="col">V (V)</th>
                            <th scope="col">M (M)</th>
                            <th scope="col">A (A)</th>
                            <th scope="col">C (C)</th>
                            <th scope="col">TC (TC)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>UAEM</td>
                            <td>150</td>
                            <td>200</td>
                            <td>5</td>
                            <td>3</td>
                            <td>358</td>
                        </tr>
                        <tr>
                            <td>UTEZ</td>
                            <td>80</td>
                            <td>120</td>
                            <td>2</td>
                            <td>1</td>
                            <td>203</td>
                        </tr>
                        <tr>
                            <td>UPEMOR</td>
                            <td>40</td>
                            <td>60</td>
                            <td>1</td>
                            <td>0</td>
                            <td>101</td>
                        </tr>
                        <tr>
                            <td>ITZ</td>
                            <td>280</td>
                            <td>100</td>
                            <td>80</td>
                            <td>10</td>
                            <td>470</td>
                        </tr>
                        <tr>
                            <td>ITC</td>
                            <td>70</td>
                            <td>250</td>
                            <td>53</td>
                            <td>5</td>
                            <td>378</td>
                        </tr>
                        <tr>
                            <td>CENIDET</td>
                            <td>90</td>
                            <td>28</td>
                            <td>89</td>
                            <td>2</td>
                            <td>209</td>
                        </tr>
                        <tr>
                            <td>UPN</td>
                            <td>27</td>
                            <td>98</td>
                            <td>4</td>
                            <td>1</td>
                            <td>130</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{-- INTERCULTURALIDAD --}}
        <div class="col-md-12">
            <h2 class="mb-4">Datos Generales</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Subsitemas</th>
                            <th scope="col">Hombres (H)</th>
                            <th scope="col">Mujeres (M)</th>
                            <th scope="col">Otros (O)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>UAEM</td>
                            <td>150</td>
                            <td>200</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>UTEZ</td>
                            <td>80</td>
                            <td>120</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>UPEMOR</td>
                            <td>40</td>
                            <td>60</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>ITZ</td>
                            <td>280</td>
                            <td>100</td>
                            <td>80</td>
                        </tr>
                        <tr>
                            <td>ITC</td>
                            <td>70</td>
                            <td>250</td>
                            <td>53</td>
                        </tr>
                        <tr>
                            <td>CENIDET</td>
                            <td>90</td>
                            <td>28</td>
                            <td>89</td>
                        </tr>
                        <tr>
                            <td>UPN</td>
                            <td>27</td>
                            <td>98</td>
                            <td>4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
