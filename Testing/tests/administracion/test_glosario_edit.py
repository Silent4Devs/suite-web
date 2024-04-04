from pages.administracion.configurar_organizacion.glosario.edit.glosario_edit_page import Edit_Gloario
def test_create_inventario_de_activos(browser):
    
    create_inventario_activos = Edit_Gloario(browser)
    create_inventario_activos.login()
    create_inventario_activos.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    create_inventario_activos.edit_glosario(campo_buscar_xpath, boton_editar, guardar_xpath)
 
#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//I[@class='material-symbols-outlined i-direct'][text()='keyboard_arrow_down'])[2]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/glosarios'][text()='Glosario']"

campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
boton_editar = "//I[@class='fas fa-edit']"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"