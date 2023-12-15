from selenium import webdriver
import os
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.common.action_chains import ActionChains
import time
tiempo_modulos=4
tiempo_carga=10
tiempo_espera=2.7
tiempo_sec=1
element_xpath0 = "(//font[@class='letra_blanca'][contains(.,'Capital Humano')])[1]"
element_xpath1= "//a[contains(.,'Solicitudes e Incidencias')]"
element_xpath2="//button[@class='btn btn-danger'][contains(.,'Guardar')]"
areas_xpaths = [
"//li[@class='select2-results__option select2-results__option--highlighted'][contains(.,'Desarrollo')]",
"//li[@class='select2-results__option select2-results__option--highlighted'][contains(.,'Arquitectura')]",
"//li[@class='select2-results__option select2-results__option--highlighted'][contains(.,'Operaciones')]",
"//li[@class='select2-results__option select2-results__option--highlighted'][contains(.,'Marketing')]",
]
select_count = 4
#driver Firefox
driver=webdriver.Firefox()

#Open URL
driver.get('https://192.168.9.78/')

#Maximize Window
driver.maximize_window()
time.sleep(5)

#Login
print("Ingresando Usuario")
usr=driver.find_element(By.XPATH,"//input[contains(@name,'email')]").send_keys("zaid.garcia@becarios.silent4business.com")
time.sleep(tiempo_modulos)
print("Ingresando Contraseña")
pw=driver.find_element(By.XPATH,"//input[contains(@name,'password')]").send_keys("ranas289")
time.sleep(tiempo_modulos)
print("Entrando a la plataforma...")
btn=driver.find_element(By.XPATH,"//button[@type='submit'][contains(.,'Enviar')]")
btn.click()

#Capital Humano
print("Entrando a Capital Humano...")
element = driver.find_element(By.XPATH, element_xpath0)
driver.execute_script("arguments[0].scrollIntoView(true);", element)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_xpath0)))
time.sleep(tiempo_modulos)
element.click()
time.sleep(tiempo_espera)

#Solictudes e Incidencias
print("Entrando a Solicitudes e Incidencias...")
element1 = driver.find_element(By.XPATH, element_xpath1)
driver.execute_script("arguments[0].scrollIntoView(true);", element1)
WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.XPATH, element_xpath1)))
time.sleep(tiempo_modulos)
element1.click()
time.sleep(tiempo_espera)

#Ajustes de Vacaciones
print("Entrando a Ajustes de Vacaciones...")
ajustes_vacaciones=driver.find_element(By.XPATH,"//a[contains(.,'Ajustes Vacaciones')]")
time.sleep(tiempo_modulos)
ajustes_vacaciones.click()
time.sleep(tiempo_espera)

        #LINEAMIENTOS
print("Entrando a Lineamientos...")
lineamientos=driver.find_element(By.XPATH,"//a[contains(.,'Lineamientos')]")
time.sleep(tiempo_modulos)
lineamientos.click()
time.sleep(tiempo_espera)

#Crear linemaientos
print("Creando Lineamiento...")
crear_lineamientos=driver.find_element(By.XPATH,"//a[contains(.,'Crear Lineamiento +')]")
time.sleep(tiempo_modulos)
crear_lineamientos.click()
time.sleep(tiempo_espera)

#Nombre del lineamiento de vacaciones
print("Ingresando nombre del lineamiento de vacaciones...")
nombre_lineamiento=driver.find_element(By.XPATH,"//input[contains(@minlength,'1')]").send_keys("北京位於華北平原的西北边缘，背靠燕山，有永定河流经老城西南，毗邻天津市、河北省。")
time.sleep(tiempo_espera)

#Tipo de conteo
print("Ingresando tipo de conteo...")
tipo_de_conteo = driver.find_element(By.XPATH, "//select[@id='tipo_conteo']")
time.sleep(tiempo_modulos)
tipo_de_conteo.click()
        #Seleccionar tipo de conteo
print("Seleccionando tipo de conteo...")
select_element = Select(tipo_de_conteo)
time.sleep(tiempo_modulos)
select_element.select_by_visible_text('Día Natural')
time.sleep(tiempo_espera)

        #Descripción
print("Agregando descripción...")
descripcion=driver.find_element(By.XPATH,"//textarea[contains(@class,'form-control')]").send_keys("Leone Sextus Denys Oswolf Fraudatifilius Tollemache-Tollemache de Orellana Plantagenet Tollemache-Tollemache")

        #Año de inicio de beneficio
print("Ingresando año de inicio de beneficio...")
#año_de_inicio_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'inicio_conteo')]").send_keys("-1")
#año_de_inicio_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'inicio_conteo')]").send_keys("0")
#año_de_inicio_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'inicio_conteo')]").send_keys("200000000000000")
año_de_inicio_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'inicio_conteo')]").send_keys("20")
time.sleep(tiempo_espera)
        #Año fin de beneficio
print("Ingresando año fin de beneficio...")
año_de_fin_de_beneficio = driver.find_element(By.XPATH, "//input[contains(@name,'fin_conteo')]").send_keys("21")
time.sleep(tiempo_espera)

        #Días a gozar
print("Ingresando días a gozar...")
dia_gozar=driver.find_element(By.XPATH,"//input[contains(@max,'24')]").send_keys("24")
time.sleep(tiempo_espera)
        #Reinicio de conteo
print("Seleccionando reinicio de conteo...")
reinicio_conteo = driver.find_element(By.XPATH, "//select[contains(@id,'corte')]")
time.sleep(tiempo_modulos)
reinicio_conteo.click()
        #Seleccionar tipo de conteo
print("Seleccionando tipo de conteo...")
select_element1 = Select(reinicio_conteo)
time.sleep(tiempo_modulos)
select_element1.select_by_visible_text('Anual')
time.sleep(tiempo_espera)

#Colaboradores a los que aplica
print("Seleccionando colaboradores a los que aplica...")
radio_value_to_select = "1"
radio_button_xpath = f"//input[@type='radio' and @value='{1}']"

radio_button = driver.find_element(By.XPATH, radio_button_xpath)
radio_button.click()

#Guardar
print("Guardando...")
time.sleep(tiempo_espera)
save_btn=driver.find_element(By.XPATH,"//button[@class='btn btn-danger'][contains(.,'Guardar')]")
time.sleep(tiempo_sec)
save_btn.click()

    #confirmación
print("Confirmando la acción de guardado...")
time.sleep(tiempo_espera)
ok_btn=driver.find_element(By.XPATH,"//button[@type='button'][contains(.,'OK')]")
ok_btn.click()

#Opciones
select_container3_xpath = f"(//i[@class='fa-solid fa-ellipsis-vertical'])[1]"
select_container3 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container3_xpath)))
select_container3.click()
time.sleep(tiempo_espera)
#Ver
time.sleep(tiempo_espera)
print("Entrando a la vita de ver...")
ver=driver.find_element(By.XPATH,"(//i[contains(@class,'fas fa-eye')])[1]")
time.sleep(tiempo_sec)
ver.click()
        #Regresar
time.sleep(tiempo_modulos)
back=driver.find_element(By.XPATH,"(//a[@class='btn btn-default'][contains(.,'Regresar')])[2]")
time.sleep(tiempo_sec)
back.click()


# Editar
print("Entrando a la vita de edición...")
time.sleep(tiempo_espera)
select_container3_xpath = f"(//i[@class='fa-solid fa-ellipsis-vertical'])[1]"
select_container3 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container3_xpath)))
select_container3.click()
time.sleep(tiempo_espera)

select_container4_xpath = f"(//i[contains(@class,'fas fa-edit')])[1]"
select_container4 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container4_xpath)))
select_container4.click()
time.sleep(tiempo_espera)

#Guardar
print("Guardando...")
save_btn_xpath = f"//button[@class='btn btn-danger'][contains(.,'Guardar')]"
save_btn=WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, save_btn_xpath)))
save_btn.click()
time.sleep(tiempo_espera)

ok_btn=driver.find_element(By.XPATH,"//button[@type='button'][contains(text(),'OK')]")
time.sleep(tiempo_sec)
ok_btn.click()

#Eliminar
select_container3_xpath = f"(//i[@class='fa-solid fa-ellipsis-vertical'])[1]"
select_container3 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container3_xpath)))
select_container3.click()
time.sleep(tiempo_espera)

# Example logging statement
time.sleep(tiempo_espera)
print("Waiting for delete element to be clickable...")
delete=WebDriverWait(driver, 10).until(
    EC.element_to_be_clickable((By.XPATH, "(//i[contains(@class,'fas fa-trash')])[1]"))
)
print("Delete element is clickable. Clicking...")
delete.click()

time.sleep(tiempo_espera)
delete_sure= driver.find_element(By.XPATH, "(//button[@class='eliminar btn btn-info'][contains(.,'Eliminar')])[1]")
time.sleep(tiempo_espera)
delete_sure.click()
time.sleep(tiempo_espera)
ok_btn=driver.find_element(By.XPATH,"//button[@type='button'][contains(text(),'OK')]")
time.sleep(tiempo_sec)
ok_btn.click()
time.sleep(tiempo_espera)

print("Test Lineamiento Vacaciones finalizado con éxito")
time.sleep(tiempo_espera)

# Example logging statement
print("Esperando a que ajustes_vacaciones element sea clickleable..")
ajustes_vacaciones = WebDriverWait(driver, 10).until(
EC.element_to_be_clickable((By.XPATH, "//a[contains(.,'Ajustes de Vacaciones')]"))
)
print("Ajustes Vacaciones element es clickleable. Continuando...")
ajustes_vacaciones.click()
time.sleep(tiempo_espera)

        #EXCEPCIONES
print("Entrando a Excepciones...")
excepciones=driver.find_element(By.XPATH,"//a[contains(.,'Excepciones')]")
time.sleep(tiempo_espera)
excepciones.click()

#Crear excepciones
time.sleep(tiempo_espera)
print("Creando excepciones...")
time.sleep(tiempo_espera)
crear_excepciones=driver.find_element(By.XPATH,"//a[contains(@type,'button')]")
time.sleep(tiempo_sec)
crear_excepciones.click()

#Creando Excepciones
time.sleep(tiempo_espera)
print("Agregando nombre de  excepciones...")
nombre_excepciones=driver.find_element(By.XPATH,"//input[contains(@type,'text')]").send_keys("北京位於華北平原的西北边缘，背靠燕山，有永定河流经老城西南，毗邻天津市、河北省，是一座有三千余年建城历史、八百六十余年建都史的历史文化名城，历史上有金、元、明、清、中华民国（北洋政府时期）等五个朝代在此定都，以及数个政权建政于此，荟萃了自元明清以来的中华文化，拥有众多历史名胜古迹和人文景观。《不列颠百科全书》将北京形容为全球最伟大的城市之一，而且断言，“这座城市是中国历史上最重要的组成部分。在中国过去的八个世纪里，不论历史是否悠久，几乎北京所有主要建筑都拥有着不可磨灭的民族和历史意义”。北京古迹众多，著名的有故宫、天坛、颐和园、圆明园、北海公园等。")
time.sleep(tiempo_sec)
dias_aplicar=driver.find_element(By.XPATH,"//input[contains(@type,'number')]").send_keys("24")
time.sleep(tiempo_sec)
aniversario=driver.find_element(By.XPATH,"//input[contains(@name,'aniversario')]").send_keys("20")

#Acción
print("Ingresando la acción...")
accion= driver.find_element(By.XPATH, "//select[contains(@name,'efecto')]")
time.sleep(tiempo_modulos)
accion.click()
        #Seleccionar tipo de conteo
print("Seleccionando la acción..")
action = Select(accion)
time.sleep(tiempo_modulos)
action.select_by_visible_text('Restar')
time.sleep(tiempo_espera)

#Descripcion
print("Agregando descripción...")
descripcion=driver.find_element(By.XPATH,"//textarea[contains(@class,'form-control')]").send_keys("وضع ابن الهيثم تصور واضح للعلاقة بين النموذج الرياضي المثالي ومنظومة الظواهر الملحوظة.")
time.sleep(tiempo_espera)

#Áreas
print("Seleccionando áreas...")
areas=driver.find_element(By.XPATH,"(//li[contains(@class,'select2-search select2-search--inline')])[1]")
time.sleep(tiempo_espera)
areas.click()

desarrollo=driver.find_element(By.XPATH,"//li[@class='select2-results__option select2-results__option--highlighted'][contains(.,'Desarrollo')]")
time.sleep(tiempo_espera)
desarrollo.click()
#Puesto
time.sleep(tiempo_espera)
Puesto=driver.find_element(By.XPATH,"(//li[contains(@class,'select2-search select2-search--inline')])[2]")
time.sleep(tiempo_espera)
Puesto.click()
print("Seleccionando puesto...")
Trainee=driver.find_element(By.XPATH,"//li[@class='select2-results__option select2-results__option--highlighted'][contains(.,'Trainee Desarrollador Web')]")
time.sleep(tiempo_espera)
Trainee.click()
#Colaborador
time.sleep(tiempo_espera)
Areas=driver.find_element(By.XPATH,"(//li[contains(@class,'select2-search select2-search--inline')])[3]")
time.sleep(tiempo_espera)
Areas.click()
print("Seleccionando colaborador...")
User=driver.find_element(By.XPATH,"//li[contains(.,'Mauricio David Blancas García')]")
time.sleep(tiempo_espera)
User.click()

#Guardar
print("Guardando...")
time.sleep(tiempo_espera)
save_btn=driver.find_element(By.XPATH,"//button[@class='btn btn-danger'][contains(.,'Guardar')]")
time.sleep(tiempo_sec)
save_btn.click()

#confirmación
ok_btn=driver.find_element(By.XPATH,"//button[@type='button'][contains(text(),'OK')]")
time.sleep(tiempo_sec)
ok_btn.click()
time.sleep(tiempo_modulos)

#Visualizar

select_container3_xpath = f"(//i[@class='fa-solid fa-ellipsis-vertical'])[1]"
select_container3 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container3_xpath)))
select_container3.click()
time.sleep(tiempo_espera)

print("Entrando a la vita de ver...")
ver=driver.find_element(By.XPATH,"(//i[contains(@class,'fas fa-eye')])[1]")
time.sleep(tiempo_sec)
ver.click()

#Regresar
time.sleep(tiempo_modulos)
back=driver.find_element(By.XPATH,"(//a[@class='btn btn-default'][contains(.,'Regresar')])[1]")
time.sleep(tiempo_sec)
back.click()

#Editar
select_container3_xpath = f"(//i[@class='fa-solid fa-ellipsis-vertical'])[1]"
select_container3 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container3_xpath)))
select_container3.click()
time.sleep(tiempo_espera)

print("Entrando a la vita de edición...")
time.sleep(tiempo_espera)
nombre_excepciones=driver.find_element(By.XPATH,"//input[contains(@type,'text')]").send_keys("Iñtërnâtiônàlizætiøn☃💪")
time.sleep(tiempo_sec)
dias_aplicar=driver.find_element(By.XPATH,"//input[contains(@type,'number')]").send_keys("2000")
time.sleep(tiempo_sec)
aniversario=driver.find_element(By.XPATH,"//input[contains(@name,'aniversario')]").send_keys("1")

#Acción
print("Ingresando la acción...")
accion= driver.find_element(By.XPATH, "//select[contains(@name,'efecto')]")
time.sleep(tiempo_modulos)
accion.click()
        #Seleccionar tipo de conteo
print("Seleccionando la acción..")
action = Select(accion)
time.sleep(tiempo_modulos)
action.select_by_visible_text('Sumar')
time.sleep(tiempo_espera)

#Guardar
print("Guardando...")
save_btn_xpath = f"//button[@class='btn btn-danger'][contains(.,'Guardar')]"
save_btn=WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, save_btn_xpath)))
save_btn.click()
time.sleep(tiempo_espera)

ok_btn=driver.find_element(By.XPATH,"//button[@type='button'][contains(text(),'OK')]")
time.sleep(tiempo_sec)
ok_btn.click()

#Eliminar
select_container3_xpath = f"(//i[@class='fa-solid fa-ellipsis-vertical'])[1]"
select_container3 = WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, select_container3_xpath)))
select_container3.click()
time.sleep(tiempo_espera)

# Example logging statement
print("Esperando a que ajustes_vacaciones element sea clickleable..")
ajustes_vacaciones = WebDriverWait(driver, 10).until(
EC.element_to_be_clickable((By.XPATH, "//a[contains(.,'Ajustes de Vacaciones')]"))
)
print("Ajustes Vacaciones element es clickleable. Continuando...")
ajustes_vacaciones.click()
time.sleep(tiempo_espera)
    #VISTA GLOBAL
print("Entrando a Vista Global..")
vista_global=driver.find_element(By.XPATH,"//a[contains(.,'Vista Global')]")
time.sleep(tiempo_espera)
vista_global.click()

#Excel
print("Descargando Excel...")
excel=driver.find_element(By.XPATH,"//a[@type='button'][contains(.,'Exportar Excel')]")
time.sleep(tiempo_espera)
excel.click()


time.sleep(tiempo_espera)

print("Ajustes Vacaciones - Test Finalizado con exito.")
time.sleep(tiempo_espera)

#Cerrar Sesión
print("Cerrando sesión...")
time.sleep(tiempo_espera)
driver.quit()
