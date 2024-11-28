@extends('layouts.app')

@section('title', 'Matrícula Inclusión')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-4 mb-4">Matrícula Inclusión</h1>
            <p class="lead mb-4">La inclusión en el contexto de la discapacidad se refiere a garantizar la participación plena
                y equitativa de las personas con discapacidad en todos los ámbitos de la sociedad. Implica eliminar las barreras
                físicas, sociales y actitudinales que limitan la participación de las personas con discapacidad en la educación,
                el empleo, el acceso a servicios, la vida comunitaria y otros aspectos de la vida diaria. La inclusión busca promover
                la igualdad de oportunidades y trato justo para las personas con discapacidad, reconociendo y respetando sus derechos,
                capacidades y diversidad. Esto implica adaptar entornos, políticas y prácticas para que sean accesibles e inclusivos, y
                fomentar una cultura de respeto, aceptación y apoyo a la diversidad de las personas con discapacidad.</p>
            <blockquote class="blockquote mb-4">
                <p class="mb-0">"La inclusión no es un programa, es una actitud."</p>
                <p class="mb-0">Garth Stein</p>
            </blockquote>
        </div>
    </div>

    <div class="row mt-5">
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
    </div>
</div>
@endsection
