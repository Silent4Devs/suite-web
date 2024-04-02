from pages.administracion.configurar_organizacion.organizacion.edit.organizacion_edit_page import Edit_organizacion

def test_organizacion_edit(browser):
    
 clasifiacion_edit = Edit_organizacion(browser)
 clasifiacion_edit.login()
 clasifiacion_edit.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 clasifiacion_edit.edit_organizacion(editar_btn_xpath, guardar_xpath)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/organizacions'][text()='Organización']"
editar_btn_xpath= "//a[contains(@href,'/admin/organizacions/') and contains(@href,'/edit') and normalize-space()='Editar Organización']"
guardar_xpath = "//BUTTON[contains(@class, 'btn') and contains(@class, 'btn-danger') and normalize-space()='Guardar']"