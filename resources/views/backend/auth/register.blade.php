
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Register Page</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="{{'/'}}deskapp/vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="{{'/'}}deskapp/vendors/images/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="{{'/'}}deskapp/vendors/images/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="{{'/'}}deskapp/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="{{'/'}}deskapp/vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="{{'/'}}deskapp/src/plugins/jquery-steps/jquery.steps.css"
		/>
		<link rel="stylesheet" type="text/css" href="{{'/'}}deskapp/vendors/styles/style.css" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
		></script>
		<script
			async
			src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
			crossorigin="anonymous"
		></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		
		<!-- End Google Tag Manager -->
	</head>

	<body class="login-page">
        
		<div
			class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{'/'}}deskapp/vendors/images/login-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Register</h2>
                        </div>
                        <form>
                            <div class="input-group custom">
                                <input
                                    type="email"
                                    class="form-control form-control-lg"
                                    placeholder="E-mail"
                                    name="email"
									id="email"
                                />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"
                                        ><i class="icon-copy dw dw-user1"></i
                                    ></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    placeholder="Fullname"
                                    name="fullname"
                                    id="fullname"
                                />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"
                                        ><i class="dw dw-user-2"></i
                                    ></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input 
									class="form-control date-picker" 
									placeholder="Pick Your Birthday" 
									type="text"
									name="birthday"
									id="birthday"
								>
                            </div>
                            <div class="input-group custom">
                                <input
                                    type="password"
                                    class="form-control form-control-lg"
                                    placeholder="**********"
                                    name="password"
                                    id="password"
                                />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"
                                        ><i class="dw dw-padlock1"></i
                                    ></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <span>
                                        Have an <a href="{{route('login')}}" class="text-primary">Account </a> ?
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button class="btn btn-primary btn-lg btn-block" type="button" onclick="register()"> 
                                            Register
                                        </button>
                                        
                                    </div>
                                    
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		</div>
	
		
		<!-- js -->
		<script src="{{'/'}}deskapp/vendors/scripts/core.js"></script>
		<script src="{{'/'}}deskapp/vendors/scripts/script.min.js"></script>
		<script src="{{'/'}}deskapp/vendors/scripts/process.js"></script>
		<script src="{{'/'}}deskapp/vendors/scripts/layout-settings.js"></script>
		<script src="{{'/'}}deskapp/src/plugins/jquery-steps/jquery.steps.js"></script>
		<script src="{{'/'}}deskapp/vendors/scripts/steps-setting.js"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
		<script>
			function register(){
				var fullname = $('#fullname').val();
				var email = $('#email').val();
				var password = $('#password').val();
				var birthday = $('#birthday').val();
				console.log(birthday);
				$.ajax({
					url : '{{route("storeRegister")}}',
					type: 'POST',
					dataType : 'JSON',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data : {
						fullname : fullname,
						email : email,
						birthday : birthday,
						password : password
					} ,
					success : function (res) {
						if (res.message === 'success') {
							Swal.fire({
								position: "top-end",
								icon: "success",
								title: res.text,
								showConfirmButton: false,
								timer: 1500
							}).then(() => {
								window.location.href = "{{ route('login') }}";
							});
						}
						
					},
					error : function (xhr, status, error, res) {
						try {
							var response = JSON.parse(xhr.responseText);
							Swal.fire({
								icon: "error",
								title: "Error",
								text: response.message,
							});
						} catch (e) {
							Swal.fire({
								icon: "error",
								title: "Error",
								text: xhr.responseText,
							});
						}
					}
				})
			}
	</script>
	</body>
	
	
</html>
