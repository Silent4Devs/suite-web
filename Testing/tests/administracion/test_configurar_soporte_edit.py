from pages.administracion.ajustes_de_sistema.configurar_soporte.edit.configurar_soporte_edit_page import Edit_configurar_soporte
 
def test_clasificacion_create(browser):
    
 clasifiacion_edit = Edit_configurar_soporte(browser)
 clasifiacion_edit.login()
 clasifiacion_edit.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 clasifiacion_edit.edit_configurarsoporte(btn_serch, btn_3Puntos, guardar_xpath)
 

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[7]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/configurar-soporte'][text()='Configurar Soporte']"
agregar_btn_xpath = "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3 agregar']"
guardar_xpath = "//button[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space(text()) = 'Guardar']"
btn_serch = "(//INPUT[@type='search'])[2]"
btn_3Puntos = "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"