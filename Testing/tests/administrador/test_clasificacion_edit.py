import pytest
from pages.administrador.ajustes_sg.clasificacion.ediit.clasifiacion_edit_page import Edit_clasificacion

#Usuario y Contraseña
#Hola


username = "cesar.escobar@silent4business.com"
password = "password"   

#Variables
menu_hamburguesa = "//BUTTON[@class='btn-menu-header']"
element_entrar_submodulo = "//A[@href='https://192.168.9.78/admin/auditorias/clasificacion-auditorias'][text()='Clasificación']"
element_confirgurar_organizacion = "//I[@class='bi bi-file-earmark-arrow-up']"
agregar_btn_xpath= "//a[@href='https://192.168.9.78/admin/auditorias/clasificacion-auditorias/create'][normalize-space()='Nueva Clasificación']"
trespuntos_btn_xpath= "(//I[@class='fa-solid fa-ellipsis-vertical'])[1]"
boton_editar = "(//I[@class='fa-solid fa-pencil'])[1]"
campo_buscar_xpath= "(//INPUT[@type='search'])[2]"

#Temporizadores
tiempo_modulos = 2

@pytest.mark.usefixtures("browser")
def test_clasificacion_create(browser):
    
 clasifiacion_create = Edit_clasificacion(browser)
 clasifiacion_create.login(username, password)
 clasifiacion_create.in_submodulo(menu_hamburguesa,element_confirgurar_organizacion,element_entrar_submodulo)
 clasifiacion_create.update_clasificacion(campo_buscar_xpath, trespuntos_btn_xpath, boton_editar)