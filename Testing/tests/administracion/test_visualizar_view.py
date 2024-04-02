from pages.administracion.ajustes_de_sistema.visualizar_logs.view.visualizar_view_page import View_visualizar
 
def test_clasificacion_create(browser):
    
 clasifiacion_create = View_visualizar(browser)
 clasifiacion_create.login()
 clasifiacion_create.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[7]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/visualizar-logs'][text()='Visualizar Logs']"