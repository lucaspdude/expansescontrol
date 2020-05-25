<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#ccc">
<table bgcolor="#fff" width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="max-width: 650px;">
  <tbody>

    <tr>
      <td height="65" valign="top" style="background-color:#ed284e; padding-left:40px; padding-right:40px; padding-top:14px;">
        <a href="http://www.ketchapp.com.br" target="_blank" style="color: #fff;text-decoration: none; font-size: 20px; font-family: 'Myriad Pro', Helvetica, Arial, 'sans-serif'; display: inline-block; padding-top: 8px;">www.<strong>ketchapp</strong>.com.br</a>
          <span style="display: inline-block;float: right;margin-left:20px;"><a href="" target="_blank" title="E-mail"><img src="{{ asset('images/emails/email.png') }}" alt="E-mail"></a></span>
          <span style="display: inline-block;float: right;margin-left:20px;"><a href="" target="_blank" title="Facebook"><img src="{{ asset('images/emails/facebook.png') }}" alt="Facebook"></a></span>
          <span style="display: inline-block;float: right;"><a href="" target="_blank" title="Instagram"><img src="{{ asset('images/emails/instagram.png') }}" alt="Instagram"></a></span>
      </td>
    </tr>

    <tr>
      <td height="121" align="center" valign="top"><img src="{{ asset('images/emails/banner.jpg') }}" width="100%" style="display:block; background-color:#fff;" alt="Ketchapp. O futuro dos food apps."/></td>
    </tr>

    <tr>
      <td style="text-align: left; padding-top: 40px; padding-left: 40px; padding-right: 40px; padding-bottom: 30px; background-color:#f7f7f7;">
        <div style="float: left; width: 280px; height: auto; color: #292525; font-family: 'Myriad Pro', Helvetica, Arial, 'sans-serif'; font-size: 17px; line-height: 22px;">
          <p style="color: #ed284e;">Olá <strong>{{ $usuario->name ?? 'TESTE' }}</strong>, tudo bem?</p>
          <p>Você solicitou a redefinição da sua senha de acesso ao Ketchapp.</p>
          <p>A sua nova senha é: <strong>{{ $token->token }}</strong></p>

        </div>
        <div style="float: right; width: 286px; height: auto;">
          <img src="{{ asset('images/emails/img-sobre.png') }}" style="display:block;" alt="Imagem ilustrativa"/>
        </div>
      </td>
    </tr>


    <tr>
      <td style="padding-top: 18px; padding-left: 40px; padding-right: 40px; padding-bottom: 18px; background-color: #f7f7f7;">
        <span style="display: inline-block; padding-top: 14px; font-size: 14px; text-align: left; font-family: 'Myriad Pro', Helvetica, Arial, 'sans-serif'; color: #ed284e;">
          <a href="" target="_blank" style="color: #ed284e;">Home</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="" target="_blank" style="color: #ed284e;">Conheça o App</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="" target="_blank" style="color: #ed284e;">Central de Ajuda</a>
        </span>
        <img src="{{ asset('images/emails/logo-ketchapp-footer.png') }}" alt="Ketchapp" style="display: inline-block; float: right;">
      </td>
    </tr>

  </tbody>
</table>
</body>
</html>
