/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;
import org.hibernate.HibernateException;
import java.lang.Object;
import org.hibernate.LockMode;
//import java.lang.Enum<LockMode>;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.Transaction;
import model.Jugador;

/**
 *
 * @author Juan
 */
public class Controlador {

    //Jugador departamentos = new Jugador();
    public static Transaction trns;

    public static Session session = null;

    boolean ban = false;

    public List<Jugador> lista = new ArrayList<Jugador>();
    public Jugador jugador = new Jugador();

    public static Session IniciarTrasaccion() {
        try {
            trns = null;
            if (!session.isOpen()) {
                session = HibernateUtil.getSessionFactory().openSession();
                session.beginTransaction();
                // Jugador desptos=new Jugador();

            } else {
//                session = HibernateUtil.getSessionFactory().getCurrentSession();
//                session.beginTransaction();
                //session.lock(Jugador.class, LockMode.PESSIMISTIC_READ);
            }
//            trns = session.beginTransaction();
        } catch (RuntimeException e) {
            session.close();
        }

        return session;
    }

    public boolean InsertarJugador(Jugador jugador, Session sesion) throws InterruptedException {

        try {

            System.out.println("session active");
            session = sesion;
            session.save(jugador);
            System.out.println("confirmado");
            session.getTransaction().commit();
            ban = true;

        } catch (RuntimeException e) {
            if (session.getTransaction() != null) {
                session.getTransaction().rollback();
                ban = false;
            }
            e.printStackTrace();
        } finally {
            session.clear();
            session.close();
        }
        return ban;
    }

    public List<Jugador> MostrarDatos() {
        List<Jugador> lista1 = new ArrayList<Jugador>();
        try {

            session = HibernateUtil.getSessionFactory().openSession();
            trns = session.beginTransaction();
            Query q = session.createQuery("from Jugador ORDER BY CODIGO");
            lista1 = (List<Jugador>) q.list();
            trns.commit();
        } catch (RuntimeException e) {
            if (trns != null) {
                trns.rollback();
            }
            e.printStackTrace();
        } finally {
            session.clear();
            session.close();
        }
        return lista1;
    }

    public List<Jugador> MostrarDatosSesion(Session sesion) {
        List<Jugador> lista1 = new ArrayList<Jugador>();
        boolean b = false;
        try {

            if (sesion == null) {
                session = HibernateUtil.getSessionFactory().openSession();
                session.beginTransaction();
                b = true;
            } else {
                session = sesion;
            }
            Query q = session.createQuery("from Jugador ORDER BY CODIGO");
            lista1 = (List<Jugador>) q.list();
            session.getTransaction().commit();

        } catch (RuntimeException e) {
//            if (trns != null) {
                session.getTransaction().rollback();
//            }
            e.printStackTrace();
        } finally {

            session.clear();
            session.close();

        }
        return lista1;
    }

    public Jugador BuscaModificarJugador(BigDecimal id, Session sesion) {

        List<Jugador> lista2 = new ArrayList<Jugador>();
        session = sesion;
        try {

            //deptos = (Jugador) session.get(Jugador.class, id);
            //deptos = (Jugador) session.get(Jugador.class, id,LockMode.READ);  //serializable solo uno podia modifar y el otro bloqueado
            jugador = (Jugador) session.get(Jugador.class, id, LockMode.UPGRADE_NOWAIT);  //Solo permite aun usuario vizualizar las datos
            //System.out.print(deptos);

//deptos = (Jugador) session.get(Jugador.class, id,LockMode.UPGRADE_SKIPLOCKED); // Los bloque la fila y queda en espera.
            // deptos = (Jugador) session.load(Jugador.class, id,LockMode.WRITE);

        } catch (HibernateException ex) {

            ex.printStackTrace();

        } finally {
            session.clear();
            //session.close();
        }
        return jugador;
    }

    public boolean ModificarDepto(BigDecimal id, String nombre, Session sesion) {
        boolean ban = true;
        session = sesion;
        try {
            jugador.setCodigo(id);
            jugador.setNombre(nombre);
            session.update(jugador);
            session.getTransaction().commit();
            sesion.get(Jugador.class, id, LockMode.NONE);//eliminar el bloqueo
            ban = true;

        } catch (HibernateException ex) {
            //mess = ex.getMessage();
            session.getTransaction().rollback();
            ex.printStackTrace();
            ban = false;
        } finally {
            session.clear();
//            session.close();
        }
        return ban;

    }

    public boolean EliminarDepto(BigDecimal id, Session sesion) {
        boolean ban = true;
        
        session = sesion;
        try {
            session.get(Jugador.class, id, LockMode.PESSIMISTIC_WRITE);  //Solo permite aun usuario vizualizar las datos
            Query query = session.createQuery("delete Jugador where IDDEPARTAMENTO='" + id + "'");
            query.executeUpdate();

            //tx.commit();
            session.getTransaction().commit();
            ban = true;

        } catch (HibernateException ex) {

            //tx.rollback();
            session.getTransaction().rollback();
            ex.printStackTrace();
            ban = false;
        }
        return ban;
    }

}
