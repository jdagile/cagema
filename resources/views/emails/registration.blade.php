<p>
  Hola! {{ $user->name }} por favor confirma tu correo electrónico,
   presionando en el siguiente enlace:

</p>

<p>
     <a href="{{ $url }}">{{ $url }}</a>
</p>
<div class="">
  <table align="center" >
  <tr >
    <br>
    <br>

    <td><img src ="{{ asset('app/media/img//logos/cicoh.png')}}"  width="70%" alt ="logo"></td>
    <td><img src ="{{ asset('app/media/img//logos/usaid.png')}}"  width="70%" alt ="logo"></td>
  </tr>
  </table>
 <h6 style="color : blue;"></h6>
 <span style="color: blue">
<small><small>CicohAlert se hace posible gracias al apoyo del pueblo estadounidense a través de la Agencia de los Estados Unidos para el Desarrollo Internacional (USAID). El contenido de este sistema es responsabilidad exclusiva de DAI y no refleja necesariamente los puntos de vista de la Agencia de Estados Unidos para el Desarrollo Internacional o del Gobierno de los Estados Unidos.</small></small></span>
  </div>
