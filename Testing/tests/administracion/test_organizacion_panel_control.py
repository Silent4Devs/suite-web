from pages.administracion.configurar_organizacion.organizacion.panel_cotrol.organizacion_panel_control_page import Edit_panel_de_control_organizacion
 
def test_organizacion_panel_de_control(browser):
    
 clasifiacion_panel_de_control = Edit_panel_de_control_organizacion(browser)
 clasifiacion_panel_de_control.login()
 clasifiacion_panel_de_control.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 clasifiacion_panel_de_control.edit_panel_de_control(panel_de_control)
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/organizacions'][text()='Organización']"
panel_de_control = "//a[contains(@class, 'btn') and contains(@class, 'btn-success') and normalize-space()='Panel de Control']"