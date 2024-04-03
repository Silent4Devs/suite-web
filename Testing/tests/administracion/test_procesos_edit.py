from pages.administracion.configurar_organizacion.procesos.edit.procesos_edit_page import Edit_Procesos
 
def test_edit_procesos(browser):
    
 edit_procesos = Edit_Procesos(browser)
 edit_procesos.login()
 edit_procesos.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 edit_procesos.edit_procesos(campo_buscar_xpath, boton_editar, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/procesos'][text()='Procesos']"

campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
boton_editar = "//I[@class='fas fa-edit']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"