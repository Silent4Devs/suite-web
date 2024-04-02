from pages.administracion.configurar_organizacion.organizacion.view.organizacion_view_page import View_organizacion
 
def test_organizacion_view(browser):
    
 clasifiacion_view = View_organizacion(browser)
 clasifiacion_view.login()
 clasifiacion_view.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/organizacions'][text()='Organización']"