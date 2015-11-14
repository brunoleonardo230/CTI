<div class="contain-to-grid sticky" style="box-shadow: 0 .25em .5em rgba(0,0,0,.5);">
    
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
      <li class="name"></li>
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
   </ul>
  <section class="top-bar-section"> 
      <ul class="left">
        <li>
          <a href="{{URL::to('/');}}">Início</a>
        </li>
	      <li class="has-dropdown">
	        <a href="#">Atendimento</a>
	        <ul class="dropdown">
	          <li><a href="{{URL::to('/atendimento');}}">Abrir Chamado</a></li>
	          <li><a href="#">Encerrar Chamado</a></li>
            <li><a href="{{URL::to('/atendimento/atendimentopendente');}}">Controle de Atendimento</a></li>
	        </ul>
	      </li>
        <li class="has-dropdown">
          <a href="#">Manutenção</a>
          <ul class="dropdown">
            <li><a href="{{URL::to('/manutencao/registro');}}">Registro de Manutenção</a></li>
            <li><a href="{{URL::to('/manutencao/historico');}}">Histórico de Manutenções</a></li>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="#">Eventos</a>
          <ul class="dropdown">
            <li><a href="{{URL::to('/eventos/registro');}}">Registro de Evento</a></li>
            <li><a href="{{URL::to('/eventos/historico');}}">Histórico de Eventos</a></li>
          </ul>
        </li>
	      <li class="has-dropdown">
          <a href="#">Chamados OI</a>
          <ul class="dropdown">
            <li><a href="{{URL::to('/chamadosoi');}}">Abrir Chamado</a></li>
            <li><a href="{{URL::to('/chamadosoi/controlechamado');}}">Controle de Chamados</a></li>
            <li><a href="{{URL::to('/chamadosoi/chamadosfinalizados');}}">Chamados Finalizados</a></li>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="#">Planejamento de TI</a>
          <ul class="dropdown">
            <li><a href="#">Iniciar Plano de Ação</a></li>
            <li><a href="#">Histórico de Planejamento</a></li>
          </ul>
        </li>
        <li class="has-dropdown">
          <a href="#">Administração</a>
          <ul class="dropdown">
            <li><a href="#">Monitoramento de Atendimento</a></li>
            <li><a href="{{URL::to('/administracao/problemas');}}">Cadastrar Problema</a></li>
            <li><a href="{{URL::to('/administracao/computadores');}}">Cadastro de Computador</a></li>
          </ul>
        </li>
        <li>
          <a href="{{URL::to('/relatorio/buscarelatorio');}}">Relatórios</a>
        </li>
	    </ul>
  </section>
</nav>
</div>