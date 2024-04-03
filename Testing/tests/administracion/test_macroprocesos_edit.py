from pages.administracion.configurar_organizacion.macroprocesos.edit.macroprocesos_edit_page import Macroprocesos_Edit_Areas
 
def test_macroprocesos_edit(browser):
    
 edit_macroprocesos = Macroprocesos_Edit_Areas(browser)
 edit_macroprocesos.login()
 edit_macroprocesos.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
 edit_macroprocesos.edit_macroprocesos(campo_buscar_xpath, trespuntos_btn_xpath, boton_editar, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/macroprocesos'][text()='Macroprocesos']"
element_entrar_modulo = "(//A[@href='#'])[3]"
agregar_btn_xpath= "//BUTTON[@class='btn btn-xs btn-outline-success rounded ml-2 pr-3']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
trespuntos_btn_xpath= "//I[@class='fa-solid fa-ellipsis-vertical']"
boton_editar = "//I[@class='fas fa-edit']"

