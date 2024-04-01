from pages.administrador.ajustes_sg.clasificacion.create.clasifiacion_create_page import Create_clasificacion
 
def test_clasificacion_create(browser):
    
 clasifiacion_create = Create_clasificacion(browser)
 clasifiacion_create.login()
 clasifiacion_create.in_submodulo(menu_hamburguesa, element_confirgurar_organizacion, element_entrar_submodulo)
 clasifiacion_create.add_clasificacion(agregar_btn_xpath)

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/auditorias/clasificacion-auditorias'][text()='Clasificación']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
agregar_btn_xpath= "//a[@href='https://192.168.9.78/admin/auditorias/clasificacion-auditorias/create'][normalize-space()='Nueva Clasificación']"


