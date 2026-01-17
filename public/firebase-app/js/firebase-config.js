// ========================================
// Firebase Configuration - المحافظة العقارية
// ========================================

import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js';
import { getFirestore, collection, addDoc, getDocs, doc, updateDoc, deleteDoc, query, orderBy } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js';
import { getAuth, signInWithEmailAndPassword, signOut, onAuthStateChanged, createUserWithEmailAndPassword } from 'https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js';

// Firebase Configuration
const firebaseConfig = {
    apiKey: "AIzaSyABixUDt7OMdP0WaeZRW1vr5_xsg-LpPao",
    authDomain: "project-811172743097267139.firebaseapp.com",
    databaseURL: "https://project-811172743097267139-default-rtdb.europe-west1.firebasedatabase.app",
    projectId: "project-811172743097267139",
    storageBucket: "project-811172743097267139.firebasestorage.app",
    messagingSenderId: "948488216437",
    appId: "1:948488216437:web:1944e4f9c163f1fbe47d3c",
    measurementId: "G-XSE097R6VC"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const auth = getAuth(app);

// Collections
const COLLECTIONS = {
    NEGATIVE_CERTIFICATES: 'negative_certificates',
    DOCUMENTS_REQUESTS: 'documents_requests',
    CONTACTS: 'contacts'
};

// Firebase Service
const FirebaseService = {

    // Negative Certificates
    async createNegativeCertificate(data) {
        try {
            const docRef = await addDoc(collection(db, COLLECTIONS.NEGATIVE_CERTIFICATES), {
                ...data,
                status: 'pending',
                created_at: new Date().toISOString()
            });
            return { success: true, id: docRef.id };
        } catch (error) {
            console.error('Error:', error);
            return { success: false, error: error.message };
        }
    },

    async getNegativeCertificates() {
        try {
            const q = query(collection(db, COLLECTIONS.NEGATIVE_CERTIFICATES), orderBy('created_at', 'desc'));
            const snapshot = await getDocs(q);
            return snapshot.docs.map(d => ({ id: d.id, ...d.data() }));
        } catch (error) {
            console.error('Error:', error);
            return [];
        }
    },

    async updateCertificateStatus(id, status) {
        try {
            await updateDoc(doc(db, COLLECTIONS.NEGATIVE_CERTIFICATES, id), {
                status,
                updated_at: new Date().toISOString()
            });
            return { success: true };
        } catch (error) {
            console.error('Error:', error);
            return { success: false };
        }
    },

    // Document Requests
    async createDocumentRequest(data) {
        try {
            const docRef = await addDoc(collection(db, COLLECTIONS.DOCUMENTS_REQUESTS), {
                ...data,
                status: 'pending',
                created_at: new Date().toISOString()
            });
            return { success: true, id: docRef.id };
        } catch (error) {
            console.error('Error:', error);
            return { success: false, error: error.message };
        }
    },

    async getDocumentRequests() {
        try {
            const q = query(collection(db, COLLECTIONS.DOCUMENTS_REQUESTS), orderBy('created_at', 'desc'));
            const snapshot = await getDocs(q);
            return snapshot.docs.map(d => ({ id: d.id, ...d.data() }));
        } catch (error) {
            console.error('Error:', error);
            return [];
        }
    },

    // Contacts
    async createContact(data) {
        try {
            const docRef = await addDoc(collection(db, COLLECTIONS.CONTACTS), {
                ...data,
                read: false,
                created_at: new Date().toISOString()
            });
            return { success: true, id: docRef.id };
        } catch (error) {
            console.error('Error:', error);
            return { success: false, error: error.message };
        }
    },

    async getContacts() {
        try {
            const q = query(collection(db, COLLECTIONS.CONTACTS), orderBy('created_at', 'desc'));
            const snapshot = await getDocs(q);
            return snapshot.docs.map(d => ({ id: d.id, ...d.data() }));
        } catch (error) {
            console.error('Error:', error);
            return [];
        }
    },

    // Authentication
    async login(email, password) {
        try {
            const userCredential = await signInWithEmailAndPassword(auth, email, password);
            return { success: true, user: userCredential.user };
        } catch (error) {
            console.error('Login error:', error);
            return { success: false, error: error.message };
        }
    },

    async logout() {
        try {
            await signOut(auth);
            return { success: true };
        } catch (error) {
            return { success: false };
        }
    },

    onAuthChange(callback) {
        return onAuthStateChanged(auth, callback);
    },

    getCurrentUser() {
        return auth.currentUser;
    }
};

// Export
window.FirebaseService = FirebaseService;
window.COLLECTIONS = COLLECTIONS;

export { FirebaseService, COLLECTIONS, db, auth };
