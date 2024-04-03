from pages.administracion.configurar_organizacion.categoria_de_activos.edit.categoria_activos_edit_page import Edit_Categoria_Activos
 
def test_edit_categoria_de_activos(browser):
    
    edit_categoria_activos = Edit_Categoria_Activos(browser)
    edit_categoria_activos.login()
    edit_categoria_activos.in_submodulo(menu_hamburguesa, element_entrar_modulo, element_entrar_submodulo)
    edit_categoria_activos.edit_categoria_activos(campo_buscar_xpath, trespuntos_btn_xpath, btn2_editar, guardar_xpath)
 
#Variables

menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_modulo = "(//A[@href='#'])[3]"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/tipoactivos'][text()='Categorias de Activos']"

campo_buscar_xpath= "(//INPUT[@type='search'])[2]"
btn2_editar = "(//A[@class='mr-2 rounded btn btn-sm'])[2]"
trespuntos_btn_xpath= "(//BUTTON[@class='btn btn-action-show-datatables-global d-none'])[1]"
guardar_xpath = "//button[contains(@class, 'btn-danger') and normalize-space(text())='Guardar']"
